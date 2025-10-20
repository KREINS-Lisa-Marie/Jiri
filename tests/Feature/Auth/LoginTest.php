<?php

use App\Models\User;

it('can display the login form', function () {

    // action

    $response = $this->get('/login');

    // assert
    $response->assertSee('Identifiez-vous')
        ->assertSeeInOrder(['<form', 'email', 'Mot de passe', '<button', 'Identifiez-vous'], true);
}
);

it('redirects to the jiri index identified as the home page after a successfull login', function () {

    $password = 'test';

    $user = User::factory()->create([
        'name' => 'Anika',
        'email' => 'anika@gmail.com',
        'password' => Hash::make($password),
    ]);

    $response = $this->post(route('login.store'), [
        'name' => $user->name,
        'email' => $user->email,
        'password' => $password,
    ]);

    /* $response = $this->post(route('login.store'), $user ); */

    $response->assertStatus(302)
        ->assertRedirect(route('jiris.index'));

});

it('verifies that a user who is not connected can not access to the jiris page', function () {

    $response = $this->get(route('jiris.index'));

    $response->assertStatus(302)
        ->assertRedirect(route('login'));
    /* ->assertSee('Identifiez-vous')
     ->assertSeeInOrder(['<form', 'email', 'Mot de passe', '<button', 'Identifiez-vous'], true);*/
});

//it('verifies that the connected user is redirected to the jiris index page when accessing the login page and that the guest ist redirected to the login page when accessing the jiris index page', function () {});

/* montre nicht homepage wenn nicht angemeldet */

/*
 *
 * Faut pas car on a deja tout ça avec fortify
 *
 *
 * it('verifies that the button creer un compte redirects to create');

it('verifies that the button mot passe oublie directs to page update');


after succesfull login it redirects to the jirs homepage which replaces homepage*/
