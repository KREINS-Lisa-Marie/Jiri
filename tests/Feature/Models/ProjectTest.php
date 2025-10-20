<?php

use App\Models\Jiri;
use App\Models\Project;
use App\Models\User;

use function Pest\Laravel\actingAs;

it('is possible to retrieve many jiris from a project',
    function () {
        // arrange

        $user = User::factory()->create();
        actingAs($user);

        Jiri::factory()->create([
            'user_id' => $user->id,
        ]);

        $project = Project::factory()->for($user)
            ->hasAttached(
                Jiri::factory()->for($user)->count(10)->state(['user_id' => $user->id])
            )->create();

        // assert

        $this->assertDatabaseCount('homeworks', 10);
        expect($project->jiris->count())->toBe(10);
    }
);
