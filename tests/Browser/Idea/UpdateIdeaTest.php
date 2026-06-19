<?php

declare(strict_types=1);

use App\Models\Idea;
use App\Models\User;

it('shows the initial input state', function (){
$this->actingAs($user = User::factory()->create());
$idea = Idea::factory()->for($user)->create();

visit(route('idea.show', $idea))
->click('@edit-idea-button')
->assertValue('title', $idea->title)
->assertValue('description', $idea->description)
->assertValue('status', $idea->status->value);

});


it('edits an existing idea', function () {
    
    $this->actingAs($user = User::factory()->create());

    $idea = Idea::factory()->for($user)->create();

    visit(route('idea.show', $idea))
        ->click('@edit-idea-button')
        ->fill('title', 'Some Example Title')
        ->click('@button-status-completed')
        ->fill('description', 'Example Description')
        ->fill('@new-link', 'https://etender.co.za')
        ->click('@submit-new-link-button')
        ->click('@new-step', 'Do thing')
        ->click('Update')
        ->assertRoute('idea.show', [$idea]);

    expect($idea = $user->ideas()->first())->toMatchArray([
        'title' => 'Some Example Title',
        'status' => 'completed',
        'description' => 'Example Description',
        'links' => [$idea->links[0], 'https://etender.com'],
    ]);

    expect($idea->steps)->toHaveCount(1);
});