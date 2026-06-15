<?php

declare(strict_types=1);

use App\Models\User;


it('creates a new idea', function () {
    
    $user = User::factory()->create();

    $this->be($user);

    visit('/ideas')
        ->click('@create-idea-button')
        ->fill('title', 'Some Example Title')
        ->click('@button-status-completed')
        ->fill('description', 'Example Description')
        ->fill('@new-link', 'https://etender.co.za')
        ->click('@submit-new-link-button')
        ->fill('@new-link', 'https://etender.com')
        ->click('@submit-new-link-button')
        ->click('@new-step', 'Do thing')
        ->click('@submit-new-link-button')
        ->click('@new-step', 'Do another thing')
        ->click('Create')
        ->assertPathIs('/ideas');

    expect($idea = $user->ideas()->first())->toMatchArray([
        'title' => 'Some Example Title',
        'status' => 'completed',
        'description' => 'Example Description',
        'links' => ['https://etender.co.za', 'https://etender.com'],
    ]);

    expect($idea->steps)->toHaveCount(2);
});