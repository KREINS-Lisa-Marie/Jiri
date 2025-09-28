<?php

use App\Enums\ContactRoles;
use App\Models\Contact;
use App\Models\Jiri;
use App\Models\Project;

it('is possible to retrieve many evaluated and many evaluators from a jiri',
function () {
// arrange
//    $jiri = \App\Models\Jiri::factory()->create();
    $jiri = Jiri::factory()

        ->hasAttached(
            Contact::factory()->count(7),
            ['role'=> ContactRoles::Evaluated->value]
            )
        ->hasAttached(
            Contact::factory()->count(3),
            ['role'=>ContactRoles::Evaluators->value]
        )

        ->create();

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
        $jiri = Jiri::factory()
            ->hasAttached(
                Project::factory()->count(10)
            )->create();

        // assert
        $this->assertDatabaseCount('homeworks', 10);
        expect($jiri->projects->count())->toBe(10);
    });





