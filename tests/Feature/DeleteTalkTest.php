<?php

namespace Tests\Feature;

use App\Models\Talk;
use App\Models\User;

test('a user can delete their talk', function () {
    $talk = Talk::factory()->create();

    $response = $this
        ->actingAs($talk->author)
        ->delete(route('talks.delete', ['talk' => $talk]));

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('talks.index'));

    $this->assertDatabaseMissing('talks', [
        'title' => $talk->title,
    ]);

});

test('a user cannot delete another user\'s talk', function () {
    $otherUser = User::factory()->create();
    $talk = Talk::factory()->create();

    $response = $this
        ->actingAs($otherUser)
        ->delete(route('talks.delete', ['talk' => $talk]));

    $response
        ->assertRedirect(route('talks.index'));

    $this->assertDatabaseHas('talks', [
        'title' => $talk->refresh()->title,
    ]);

});
