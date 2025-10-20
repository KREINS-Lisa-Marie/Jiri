<?php

use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\UploadedFile;

// use Illuminate\Support\Facades;
use Illuminate\Support\Facades\Storage;

use function Pest\Laravel\actingAs;

it('creates a Contact and redirects to the contact index', function () {
    // arrange

    $user = User::factory()->create();
    actingAs($user);

    Storage::fake();

    $avatar = UploadedFile::fake()->image('photo.jpg');

    $form_data = [
        'name' => 'Dominique Vilain',
        'email' => 'dominique.vilain@hepl.be',
        'avatar' => $avatar,
    ];

    // act
    $response = $this->post(
        route('contacts.store'),
        $form_data
    );

    // assert

    $contact = Contact::first();

    $response->assertStatus(302);

    /*$image = Image::read(Storage::disk('public')->get($contact->avatar));  // muss read sein!!!

    // dd($image->width());

    expect($image->width())
        ->toBeLessThanOrEqual(300)  // brauch ein config für bild size
        ->and($image->height())
        ->toBeLessThanOrEqual(300);*/

    $response->assertRedirect(route('contacts.show', compact('contact')));
    \Pest\Laravel\assertDatabaseHas('contacts',
        ['name' => 'Dominique Vilain',
            'email' => 'dominique.vilain@hepl.be',
        ]);
});

it('allows to see a contact edit page for a connected user', function () {

    $user = User::factory()->create();
    actingAs($user);

    $contact = Contact::factory()->for($user)->create();

    $response = $this->get(route('contacts.edit', $contact));

    $response->assertStatus(200);
    $response->assertSee($contact->name);
});
