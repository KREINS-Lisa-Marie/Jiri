<?php

use App\Enums\ContactRoles;
use App\Models\Contact;
use App\Models\Jiri;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\QueryException;

use function Pest\Laravel\actingAs;

it('creates a Project and redirects to the project index', function () {
    // arrange

    $user = User::factory()->create();
    actingAs($user);

    $project = Project::factory(3)->for($user)->create();


    $response = $this->post(route('projects.store'), $project->toArray());

    //assert
    $response->assertStatus(302);



    /*$project = Project::factory()->make()->toArray();

    // act
    $response = $this->post('projects', $project);

    // assert
    $response->assertStatus(302);
    $response->assertRedirect('projects');
    \Pest\Laravel\assertDatabaseHas('projects', [
        'name' => $project['name'],
    ]);*/

});


it('verifies that by clicking on a Projectlink, a user goes to the page of the Project', function () {
    // arrange
    $user = User::factory()->create();
    actingAs($user);

    $project = Project::factory(3)->for($user)->create();

    // act
    $response = $this->get('projects/' . $project->first()->id);

    // assert
    $response->assertStatus(200);
    $response->assertSee($project->first()->name, false);
});

