<?php

namespace Tests\Feature;

use App\Models\Talk;
use App\Models\User;

test('a user can update their talk', function () {
    $talk = Talk::factory()->create();

    $response = $this
        ->actingAs($talk->author)
        ->patch(route('talks.update', ['talk' => $talk]), [
            'title' => 'New Title Here',
            'length' => $talk->length,
            'type' => $talk->type,
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('talks.show', [
            'talk' => $talk,
        ]));

    $this->assertEquals('New Title Here', $talk->refresh()->title);

});

test('a user cannot update another user\'s talk', function () {
    $user = User::factory()->create();
    $talk = Talk::factory()->create();

    $response = $this
        ->actingAs($user)
        ->patch(route('talks.update', ['talk' => $talk]), [
            'title' => 'New Title Here',
            'length' => $talk->length,
            'type' => $talk->type,
        ]);

    $response
        ->assertForbidden();

    $this->assertDatabaseHas('talks', [
        'title' => $talk->refresh()->title,
    ]);

});
