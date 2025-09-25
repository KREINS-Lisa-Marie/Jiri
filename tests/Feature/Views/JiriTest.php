<?php

use function Pest\Laravel\get;

it(
    'verifies that the jiris.create route displays a form to create a jiri',
    function (string $locale, string $main_heading) {
        // arrange
        \Illuminate\Support\Facades\App::setLocale($locale);
        $response = get(route('jiris.create'));
        // act

        // assert
        /*$response->assertStatus(200);*/
        $response->assertSee("<h1>$main_heading</h1>", false);

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
