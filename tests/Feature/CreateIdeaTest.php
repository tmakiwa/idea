<?php

use App\Models\User;
use function Pest\Laravel\actingAs;

it('creates a new idea', function () {
    $user = User::factory()->create();

    actingAs($user);

    visit('/ideas')
        ->click('@create-idea-button')
        ->fill('title', 'Some Example Title')
        ->click('@button-status-completed')
        ->fill('description', 'Example Description')
        ->fill('@new-link', 'https://etender.co.za')
        ->click('@submit-new-link-button')
        ->fill('@new-link', 'https://etender.com')
        ->click('@submit-new-link-button')
        ->click('Create')
        ->assertPathIs('/ideas');

    expect($user->ideas()->first())->toMatchArray([
        'title' => 'Some Example Title',
        'status' => 'completed',
        'description' => 'Example Description',
        'links' => ['https://etender.co.za', 'https://etender.com'],
    ]);
});