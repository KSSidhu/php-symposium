<?php

namespace Tests\Feature;

use App\Models\Talk;
use App\Models\User;

test('it lists talks on talks index page', function () {
    $user = User::factory()
        ->has(Talk::factory()->count(2))
        ->create();
    $otherUserTalk = Talk::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get(route('talks.index'))
        ->assertSee($user->talks->first()->title)
        ->assertDontSee($otherUserTalk->title);

    $response->assertOk();
});

test('it shows basic talk details on talk show page', function () {
    $talk = Talk::factory()->create();

    $response = $this
        ->actingAs($talk->author)
        ->get(route('talks.show', ['talk' => $talk]))
        ->assertSee($talk->title)
        ->assertSee($talk->organizer_notes)
        ->assertSee($talk->abstract);

    $response->assertOk();
});

test('users cannot see talk show page for other talks', function () {
    $talk = Talk::factory()->create();
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get(route('talks.show', ['talk' => $talk]))
        ->assertForbidden();
});
