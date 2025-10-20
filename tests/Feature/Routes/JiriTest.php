<?php

use App\Models\Contact;
use App\Models\Jiri;
use App\Models\Project;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

test('the application returns a successful response', function () {
    $response = get('/');

    $response->assertStatus(200);
});

/*it('creates a Jiri and redirects to the jiri index',
    function () {
        //arrange
        $jiri = [
            'name' => 'Design Web 0925',
            'date' => \Carbon\Carbon::now(),
            'description' => null,
        ];

        //act
        $response = $this->post('jiris', $jiri);

        //assert
        $response->assertStatus(302);
        $response->assertRedirect('jiris');
        \Pest\Laravel\assertDatabaseHas('jiris', ['name' => 'Design Web 0925',]);

    }
);*/

it('redirects to the jiri index route after the successfull creation of a jiri',
    function () {
        // arrange
        $user = User::factory()->create();
        actingAs($user);

        $jiri = Jiri::factory()->for($user)->raw();

        // act
        $response = post(route('jiris.store'), $jiri);

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('jiris.index'));

    }
);

it('creates a Contact and redirects to the contact index', function () {
    // arrange

    $user = User::factory()->create();
    actingAs($user);

    $contact = Contact::factory()->for($user)->make([
        'name' => 'Dominique Vilain',
        'email' => 'dominique.vilain@hepl.be',
        'avatar'=>'',
    ])->toArray();

    // act
    $response = $this->post(route('contacts.store', $contact));

    // assert
    $response->assertStatus(302);
    $contact = Contact::first();
    $response->assertRedirect(route('contacts.show', $contact->id));
    \Pest\Laravel\assertDatabaseHas('contacts',
        ['name' => 'Dominique Vilain',
            'email' => 'dominique.vilain@hepl.be',
        ]);
});

/*it('creates a Project and redirects to the project index', function () {
    //arrange
    $project = [
        'name' => 'Projet Client',
    ];

    //act
    $response = $this->post('projects', $project);

    //assert
    $response->assertStatus(302);
    $response->assertRedirect('projects');
    \Pest\Laravel\assertDatabaseHas('projects',
        [
            'name' => 'Projet Client',
        ]);

});*/

it('creates a Project and redirects to the project index', function () {
    // arrange
    $user = User::factory()->create();
    actingAs($user);

    $project = Project::factory()->for($user)->make([
        'name' => 'bonjour',

    ])->toArray();

    // act
    $response = $this->post(route('projects.store'),$project);
    //$response->dump();
    // assert
    $response->assertStatus(302);
    $response->assertRedirect(route('projects.index'));
    \Pest\Laravel\assertDatabaseHas('projects', [
        'name' => $project['name'],
    ]);

});

it('displays a list of Jiris on the jiri index', function () {
    // arrange
    $user = User::factory()->create();
    actingAs($user);

    $jiris = Jiri::factory(3)->create(['user_id' => $user->id]);

    // act

    $response = $this->get('/jiris');

    // assert
    $response->assertStatus(200);
    $response->assertSee('liste des Jiris', false);

    /*    \Pest\Laravel\assertDatabaseHas('projects',
        ['name'=>'Projet Client',
        ]);*/

}
);

it('verifies if there are no jiris and displays an error message if there are none', function () {

    // act
    $user = User::factory()->create();
    actingAs($user);

    $response = $this->get('/jiris');

    // assert
    $response->assertStatus(200);
    $response->assertSee('Il n’y a pas de Jiris', false);
}
);

it('displays a detail page of Jiris and verifies if there is data', function () {
    // arrange
    $user = User::factory()->create();
    actingAs($user);

    $jiris = Jiri::factory(3)->create(['user_id' => $user->id]);

    // act
    $response = $this->get('jiris/'.$jiris->first()->id);

    // assert
    $response->assertStatus(200);
    $response->assertSee($jiris->first()->name, false);

});

it('verifies that by clicking on a Jirilink, a user is redirected to the page of the Jiri', function () {
    // arrange

    $user = User::factory()->create();
    actingAs($user);

    $jiri = Jiri::factory()->for($user)->create();

    // act
    $response = $this->get('jiris/'.$jiri->id);

    // assert
    $response->assertStatus(200);
    $response->assertSee($jiri->first()->name, false);
    /* $contacts = Contact::factory(3)->create();

    // act
    $response = $this->get('contacts/'.$contacts->first()->id);

    // assert
    $response->assertStatus(200);
    $response->assertSee($contacts->first()->name, false);*/
});

it('verifies that by clicking on a Projectlink, a user is redirected to the page of the Project', function () {
    // arrange

    $user = User::factory()->create();
    actingAs($user);

    $project = Project::factory()->for($user)->create();

    // act
    $response = $this->get('projects/'.$project->id);

    // assert
    $response->assertStatus(200);
    $response->assertSee($project->first()->name, false);

    /*
     $user = User::factory()->create(['user_id' => 115]);
     actingAs($user);


     $projects = Project::factory(3)->for($user)->create();

     // act
     $response = $this->get('projects/'.$projects->first()->id);

     // assert
     $response->assertStatus(200);
     $response->assertSee($projects->first()->name, false);*/
});

it('verifies that the obligations are respected', function () {
    // arrange
    $user = User::factory()->create();
    actingAs($user);

    $jiris = Jiri::factory()->create(['user_id' => $user->id,
    ]);

    // act
    $response = $this->get('jiris/'.$jiris->first()->id);

    // assert
    $response->assertStatus(200);
    $response->assertValid();

    // arrange
    $contacts = Contact::factory()->create(['user_id' => $user->id]);

    // act
    $response = $this->get('contacts/');

    // assert
    $response->assertStatus(200);
    $response->assertValid();

});
