<?php

use App\Models\Contact;
use App\Models\Jiri;
use App\Models\User;

use function Pest\Laravel\actingAs;

//           ****    still in production at the moment   ****

it('it is possible to associate many Jiris to a Contact',
    function () {
        // arrange
        $user = User::factory()->create();
        actingAs($user);

        $contact = Contact::factory()->for($user)
            ->hasAttached(
                Jiri::factory()->for($user)->count(3)->state(['user_id' => $user->id]),
                fn () => ['role' => 'evaluator']
            )->create();

        // assert

        $this->assertDatabaseCount('attendances', 3);
        expect($contact->jiris->count())->toBe(3);
    }
);
