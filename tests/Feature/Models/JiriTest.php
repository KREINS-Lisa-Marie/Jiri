<?php

use App\Enums\ContactRoles;
use App\Models\Contact;
use App\Models\Homework;
use App\Models\Jiri;
use App\Models\Project;
use App\Models\User;
use function Pest\Laravel\actingAs;

it('is possible to retrieve many evaluated and many evaluators from a jiri',
    function () {
        // arrange
        //    $jiri = \App\Models\Jiri::factory()->create();
        $jiri = Jiri::factory()

            ->hasAttached(
                Contact::factory()->count(7),
                ['role' => ContactRoles::Evaluated->value]
            )
            ->hasAttached(
                Contact::factory()->count(3),
                ['role' => ContactRoles::Evaluators->value]
            )

            ->create(['user_id' => Auth::id()]);

        // assert
        $this->assertDatabaseCount('attendances', 10);
        expect($jiri->evaluators->count())->toBe(3)
            ->and($jiri->evaluated->count())->toBe(7)
            ->and($jiri->contacts->count())->toBe(10)
            ->and($jiri->attendances->count())->toBe(10);
    }
);

it('is possible to retrieve many projects from a jiri',
    function () {
        // arrange
        $user = User::factory()->create();
        actingAs($user);

        $jiri = Jiri::factory()
            ->hasAttached(
                Project::factory()->count(10)
            )->create(['user_id' => Auth::user()->id]);

        // assert
        $this->assertDatabaseCount('homeworks', 10);
        expect($jiri->projects->count())->toBe(10);
    });

it('allows an evaluated contact to be linked to a homework through an implementation',
    function () {
        // arrange
        $user = User::factory()->create();
        actingAs($user);

        $jiri = Jiri::factory()->create(['user_id' => Auth::user()->id]);
        $project = Project::factory()->create();
        $evaluated = Contact::factory()->create();

        $jiri->contacts()->attach($evaluated->id, ['role' => ContactRoles::Evaluated->value]);
        $jiri->projects()->attach($project->id);

        $homework = Homework::first();

        // Act
        $evaluated->homeworks()->attach($homework->id);

        // Assert
        \Pest\Laravel\assertDatabaseCount('implementations', 1);

    });
