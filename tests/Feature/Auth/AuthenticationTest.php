<?php

use App\Models\User;

it("can display the login form", function (){


    //action

    $response = $this->get('/login');

    //assert
    $response->assertSee('Identifiez-vous')
             ->assertSeeInOrder(['<form', 'email', 'Mot de passe', '<button', 'Identifiez-vous'], true);
}
);


it('redirects to the jiri index identified as the home page after a successfull login', function (){

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

    /*$response = $this->post(route('login.store'), $user );*/

    $response->assertStatus(302)
        ->assertRedirect(route('jiris.index'));

});


it('redirects to the register page when the register link is clicked', function () {


    $response = $this->get(route('register'));

    $response->assertStatus(200)
        ->assertSee('Créer un compte')
        ->assertSeeInOrder(['<form', 'email', 'name', 'Mot de passe', '<button', 'Créer un compte'], true);

});

it('verifies that a user who is not connected can not access to the jiris page', function () {

    $response = $this->get(route('jiris.index'));

    $response->assertStatus(302)
        ->assertRedirect(route('login'));
       /* ->assertSee('Identifiez-vous')
        ->assertSeeInOrder(['<form', 'email', 'Mot de passe', '<button', 'Identifiez-vous'], true);*/
});


it('verifies that the user connected to the dashboard is the same person than the dashboard shown', function () {



$user = User::factory()->create();
$user2 = User::factory()->make();




});




/* montre nicht homepage wenn nicht angemeldet*/

/*
 *
 * Faut pas car on a deja tout ça avec fortify
 *
 *
 * it('verifies that the button creer un compte redirects to create');

it('verifies that the button mot passe oublie directs to page update');


after succesfull login it redirects to the jirs homepage which replaces homepage*/
