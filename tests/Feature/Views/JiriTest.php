<?php

use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it(
    'verifies that the jiris.create route displays a form to create a jiri',
    function (string $locale, string $main_heading) {
        // arrange
        $user = User::factory()->create();
        actingAs($user);

        \Illuminate\Support\Facades\App::setLocale($locale);
        $response = get(route('jiris.create'));
        // act

        // assert
        /* $response->assertStatus(200); */
        $response->assertSee("$main_heading", false);
    }
)->with(
    [
        ['fr', 'Créez un Jiri'],
        ['en', 'Create a Jiri'],
    ]
);

it('displays an error message when the name is misssing',
    function () {
        // arrange

        // act

    }
);
