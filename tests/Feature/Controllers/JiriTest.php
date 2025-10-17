<?php

use App\Enums\ContactRoles;
use App\Models\Contact;
use App\Models\Jiri;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\QueryException;

use function Pest\Laravel\actingAs;

beforeEach(function () {
    $this->user = User::factory()->create();

    actingAs($this->user);
});

test('the application returns a successful response', function () {
    $response = $this->get('/');

    /*    $response->assertStatus(200); */
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

it('creates successfully a Jiri from the data provided by the request',
    function () {
        // arrange

        $user = User::factory()->create();
        actingAs($user);

        //$jiri = Jiri::factory()->for($user)->create();
        $jiri = Jiri::factory()->for($user)->create();
        //$jiri = Jiri::factory()->raw();

        // act
        $response = $this->post(route('jiris.store'), $jiri->toArray());

        // assert
        /*        $response->assertStatus(302);
                $response->assertRedirect('jiris');*/
        \Pest\Laravel\assertDatabaseHas('jiris', ['name' => $jiri['name']]);

    }
);

it(
    'fails to create a new jiri in database when the name is missing in the request',
    function () {
        // arrange
        $user = User::factory()->create();
        actingAs($user);

        $jiri = Jiri::factory()
            ->withoutName()->for($user)
            ->raw();

        $response = $this->post('jiris', $jiri);
        // expect($response)->toThrow(QueryException::class);

        // assert
        $response->assertInvalid('name');
        \Pest\Laravel\assertDatabaseEmpty('jiris');

    }
);

it(
    'fails to create a new jiri in database when the date is missing in the request',
    function () {
        // arrange
        $user = User::factory()->create();
        actingAs($user);

        $jiri = Jiri::factory()
            ->withoutDate()
            ->raw();

        $response = $this->post('jiris', $jiri);
        // expect($response)->toThrow(QueryException::class);

        // assert
        $response->assertInvalid('date');
        \Pest\Laravel\assertDatabaseEmpty('jiris');

    }
);

it(
    'fails to create a new jiri in database when the date is the wrong format in the request',
    function () {
        // arrange
        $user = User::factory()->create();
        actingAs($user);

        $jiri = Jiri::factory()
            ->withInvalidDate()
            ->raw();

        $response = $this->post('jiris', $jiri);
        // expect($response)->toThrow(QueryException::class);

        // assert
        $response->assertInvalid('date');
        \Pest\Laravel\assertDatabaseEmpty('jiris');

    }
);


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

it('displays a list of Jiris on the jiri index', function () {
    // arrange
    $user = User::factory()
        ->hasJiris(3)
        ->create();

    $user2 = User::factory()
        ->hasJiris(3)
        ->create();

    actingAs($user);

    // act
    $response = $this->get(route('jiris.index'));

    // assert
    $response->assertStatus(200);
    $response->assertSee(auth()->user()->jiris->pluck('name')->toArray());
    $response->assertDontSee($user2->jiris->pluck('name')->toArray());

});

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

    $jiris = Jiri::factory(3)
        ->for($user)
        ->create();

    // act
    $response = $this->get('jiris/' . $jiris->first()->id);

    // assert
    $response->assertStatus(200);
    $response->assertSee($jiris->first()->name, false);

});

it('displays the details page of a contact', function () {
    // arrange
    $user = User::factory()->create();
    actingAs($user);

    $contact = Contact::factory()->for($user)->create();          //changer !!!  ≠ contact

    // act
    $response = $this->get(route('contacts.show', compact('contact')));

    // assert
    $response->assertStatus(200);
    $response->assertSee($contact->name, false);
});

it('verifies that the obligations are respected', function () {
    // arrange

    $user = User::factory()->create();
    actingAs($user);

    $jiri = Jiri::factory()
        ->for($user)
        ->create();

    // act
    $response = $this->get(route('jiris.show', ['jiri' => $jiri->id]));

    // assert
    $response->assertStatus(200);

    // arrange
    $contacts = Contact::factory()->for($user)->create();

    // act
    $response = $this->get('contacts/');

    // assert
    $response->assertStatus(200);

});

it('it verifies if the data is correctly submitted to the database when you create a jiri including creating a list of projects',
    function () {

        $user = User::factory()->create();
        actingAs($user);

        $form_data = Jiri::factory()->for($user)->raw();

        $projects = Project::factory()->for($user)
            ->count(2)
            ->create()
            ->pluck('id', 'id')
            ->toArray();

        $form_data['projects'] = $projects;
        // $contacts = Contact::factory()->count(5)->raw();

        // Act
        $response = $this->post(route('jiris.store'), $form_data);

        // Assert
        \Pest\Laravel\assertDatabaseCount('homeworks', 2);

    });

/*


it('it verifies if the data is correctly submitted to the database when you create a jiri',
    function () {

        $jiri = Jiri::factory()->raw();

        $contacts = Contact::factory()->count(5)->raw();
     $projects = Project::factory()->count(4)->make()->toArray();

//        $projects_data = array_map(function ($data){
//            return $data['name'];
//        }, $projects);

 $projects_data=[];
foreach ($projects as $data){
array_push($projects_data, $data['name']);
}
    dd($projects_data);


        //$form_data = array_merge($contacts, $projects);

        $response = $this->post('/jiris/store', $form_data);



        dd($form_data);
    });





*/

it('it creates a jiri from the request data including a list of attendances',
    function () {

        $user = User::factory()->create();
        actingAs($user);

        $form_data = Jiri::factory()->for($user)->raw();

        $contacts = Contact::factory()
            ->count(5)->for($user)
            ->create()
            ->pluck('id', 'id')
            ->toArray();

        $available_roles = [
            '1' => ContactRoles::Evaluators->value,
            '2' => ContactRoles::Evaluated->value,
        ];

        $form_data['contacts'] = $contacts;

        foreach ($contacts as $key => $contact) {
            $form_data['contacts'][$key] = ['role' => $available_roles[rand(1, 2)]];
        }
        // dd($form_data);

        // Act
        $response = $this->post(route('jiris.store'), $form_data);

        // Assert
        expect(\App\Models\Attendance::all()->count())->toBe(5);
    });

/*
 *         $available_roles =[
            '1' => 'none',
            '2' => ContactRoles::Evaluators->value,
            '3' => ContactRoles::Evaluated->value,
        ];

        $roles = [];
        foreach ($contacts as $key=>$contact){
            $roles[$key] = $available_roles[rand(1,3)];
        }
//dd($roles);

$form_data['roles'] = $roles;
*/

it('creates a jiri from the data submitted by the request', function () {

    $user = User::factory()->create();
    actingAs($user);

    $data = Jiri::factory()->for($user)->raw();
    /*    $data = Jiri::make([
            'name'=> $request->name,
            'date'=> $request->date,
            'description'=> $request->description,
        ]);*/

    $response = $this->post(route('jiris.store'), $data);

    $response->assertStatus(302);
    $response->assertValid();

    $this->assertDatabaseHas('jiris', [
        'name' => $data['name'],
        //'description' => $data['description'],
        'date' => $data['date'],
    ]);
});


