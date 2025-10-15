<?php

use App\Models\Contact;
use App\Models\User;

use function Pest\Laravel\actingAs;


it('creates a Contact and redirects to the contact index', function () {
    // arrange

    $user = User::factory()->create();
    actingAs($user);

    \Illuminate\Support\Facades\Storage::fake('public');

    $avatar =  \Illuminate\Http\UploadedFile::fake()->image('photo.jpg');

    $contact = [
        'name' => 'Dominique Vilain',
        'email' => 'dominique.vilain@hepl.be',
        'avatar' => $avatar,
    ];

    // act
    $response = $this->post(route('contacts.store'), $contact);

    // assert
    $contact = Contact::first();
    \Illuminate\Support\Facades\Storage::disk('public')->assertExists($contact->avatar);

    $response->assertStatus(302);
    $response->assertRedirect(route('contacts.show', compact('contact')));
    \Pest\Laravel\assertDatabaseHas('contacts',
        ['name' => 'Dominique Vilain',
            'email' => 'dominique.vilain@hepl.be',
        ]);

});
