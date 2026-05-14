<?php

use App\Models\Idea;
use App\Models\User;

it('creates a new idea', function(){
    $this->actingAs(User::factory()->create());

visit('/ideas')
->click('@create-idea-button')
->fill('title', 'Some title Eaxmple')
->click('@button-status-completed')
->fill('description', 'Example Description')
->click('Create')
->assertPathIs('/ideas');

expect(Idea::count()->toBe(1));

});