<?php

use App\Enums\ContactRoles;
use App\Models\Contact;
use App\Models\Jiri;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\QueryException;

use function Pest\Laravel\actingAs;


it('creates a Contact and redirects to the contact index', function () {
    // arrange
    $contact = [
        'name' => 'Dominique Vilain',
        'email' => 'dominique.vilain@hepl.be',
    ];

    // act
    $response = $this->post('/contacts', $contact);

    // assert
    $response->assertStatus(302);
    $response->assertRedirect('/contacts');
    \Pest\Laravel\assertDatabaseHas('contacts',
        ['name' => 'Dominique Vilain',
            'email' => 'dominique.vilain@hepl.be',
        ]);
});
