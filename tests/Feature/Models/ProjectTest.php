<?php

use App\Models\Jiri;
use App\Models\Project;

it('is possible to retrieve many jiris from a project',
function () {
// arrange

    $project = Project::factory()
        ->hasAttached(
            Jiri::factory()->count(10)
        )->create();

// assert

    $this->assertDatabaseCount('homeworks', 10);
    expect($project->jiris->count())->toBe(10);
}
);

