<?php

use App\Models\Jiri;
use App\Models\Project;
use App\Models\User;

use function Pest\Laravel\actingAs;

it('verifies if a form is displayed on the reset password page', function () {

    $response = $this->get('forgot-password');

    $response->assertStatus(200)
        ->assertSee('Mot de passe oublié');

});
