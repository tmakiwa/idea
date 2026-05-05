<?php

use Illuminate\Support\Facades\Auth;

it('registers a user', function () {
    visit('/register')
        ->fill('name', 'Tinashe Makiwa')
        ->fill('email', 'tlmakiwa@gmail.com')
        ->fill('password', '1234567890')
        ->click('Create Account')
        ->assertPathIs('/');

    $this->assertAuthenticated();

    expect(Auth::user())->toMatchArray([

        'name' => 'Tinashe Makiwa',
        'email' => 'tlmakiwa@gmail.com',

    ]);
});
