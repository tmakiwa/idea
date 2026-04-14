<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;

it('logs in a user', function () {
$user = User::factory()->create(['password' => '1234567890']);


visit('/login')
->fill('email', 'tlmakiwa@gmail.com') 
->fill('password', '1234567890')
->click('@login-button')
->assertPathIs('/');

$this->assertAuthenticated();

});

