<?php

use App\Models\Contact;
use App\Models\Jiri;

   //           ****    still in production at the moment   ****


it('it is possible to associate many Jiris to a Contact',
    function () {
        // arrange
        $contact = Contact::factory()
            ->hasAttached(
                Jiri::factory()->count(3),
                ['role' => 'evaluator']
    )->create();

        // assert

        $this->assertDatabaseCount('attendances', 3);
        expect($contact->jiris->count())->toBe(3);
    }
);


