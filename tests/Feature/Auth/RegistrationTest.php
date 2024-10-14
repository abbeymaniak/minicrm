<?php

use Spatie\Permission\Models\Role;
use App\Models\User;

beforeEach(function () {
    // Ensure the 'user' role exists before the test
    Role::firstOrCreate(['name' => 'user', 'guard_name' => 'web']); // Specify the 'web' guard
});

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register', function () {
    $response = $this->post('/register', [
        'first_name' => 'TestUser',
        'last_name' => 'lastName',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    // $response->assertStatus(201);

    // Retrieve the user from the database
    $user = User::where('email', 'test@example.com')->first();

    // Check if the user exists and has been created
    $this->assertNotNull($user);

    // Assign the role to the user
    $user->assignRole('user');

    // $response->assertSessionDoesntHaveErrors();
    // dd($response->getContent()); // Add this line for debuggings
    // Assert the user is authenticated
    // $this->assertAuthenticated();

    // Assert the user is authenticated
    $this->assertAuthenticatedAs($user);
    // expect(auth()->check())->toBeTrue();


    // $response->assertStatus(302);

    // $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard', absolute: false));
});
