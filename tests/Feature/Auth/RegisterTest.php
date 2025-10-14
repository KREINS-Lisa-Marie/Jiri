<?php

use App\Models\Jiri;
use App\Models\User;

use function Pest\Laravel\actingAs;


it('redirects to the register page when the register link is clicked', function () {

    $response = $this->get(route('register'));

    $response->assertStatus(200)
        ->assertSee('Créer un compte')
        ->assertSeeInOrder(['<form', 'email', 'name', 'Mot de passe', '<button', 'Créer un compte'], true);

});

it('can display the register form', function () {

        $response = $this->get(route('register'));

        $response->assertStatus(200)
            ->assertSeeInOrder(['Créez un compte', '<form', 'email', 'Mot de passe', '<button', 'Créer un compte']);

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
