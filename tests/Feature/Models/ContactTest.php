<?php

use App\Models\Contact;
use App\Models\Jiri;
use App\Models\Project;

/*it('is possible to retrieve many jiris from a project',
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
);*/

   //           ****    still in production at the moment   ****


it('it is possible to associate many Jiris to a contact',
    function () {
        // arrange
        $contact = Contact::factory()
            ->hasAttached(
                Jiri::factory()->count(3)
            )->create();

        // assert

        $this->assertDatabaseCount('attendances', 3);
        expect($contact->jiris->count())->toBe(3);
    }
);


