<?php

use App\Models\Jiri;
use App\Models\User;

use function Pest\Laravel\actingAs;

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

it('verifies if that a guest cannot access the jiri page', function () {

    Event::fake();
    $user = User::factory()->has(Jiri::factory()->count(3))->create();

    $response = $this->get(route('jiris.index'));
    $response->assertStatus(302)
        ->assertRedirect('/login');

});

it('verifies that the user connected to the dashboard is the same person than the dashboard shown', function () {
    // arrange
    Event::fake();

    $user = User::factory()
        ->has(\App\Models\Jiri::factory()
            ->count(3))
        ->create();
    $user2 = User::factory()->has(\App\Models\Jiri::factory()->count(2))->create();

    actingAs($user);

    $response = $this->get(route('jiris.index'));

    $response->assertStatus(200);
    $response->assertSeeText($user->name);

});

it('verifies that a user cannot modify a jiri from another user', function () {

    Event::fake();

    $user = User::factory()->create();
    $user2 = User::factory()->create();
    actingAs($user);

    $jiri = Jiri::factory()
        ->for($user)
        ->create();

    $jiri2 = Jiri::factory()
        ->for($user2)
        ->create();

    $response = $this->get(route('jiris.edit', ['jiri' => $jiri2]));

    // faut faire policies

    $response->assertStatus(403);
    // ->assertSee();

});

/* montre nicht homepage wenn nicht angemeldet */

/*
 *
 * Faut pas car on a deja tout ça avec fortify
 *
 *
 * it('verifies that the button creer un compte redirects to create');

it('verifies that the button mot passe oublie directs to page update');


after succesfull login it redirects to the jirs homepage which replaces homepage*/
