<?php

use App\Events\JiriCreatedEvent;
use App\Listeners\SendJiriCreatedEmailListener;
use App\Models\Jiri;
use App\Models\User;
use function Pest\Laravel\post;
use \Illuminate\Support\Facades\{Event, Mail};

it("fires an event asking to queue an email to send to the author after the creation of a Jiri", function (){

     \Illuminate\Support\Facades\Event::fake();          //désactive les écouteurs d'evenements

    // \Illuminate\Support\Facades\Mail::fake();
    $user = User::factory()->create();
    $this->actingAs($user);

    $formData = Jiri::factory()->raw();

    post(route('jiris.store'), $formData);
    $jiri = Jiri::first();

    Event::assertListening(
        JiriCreatedEvent::class,
        SendJiriCreatedEmailListener::class
    );
    Event::assertDispatched( JiriCreatedEvent::class);


    //Mail::assertSent(App\Mail\JiriCreatedMail::class);
    //Mail::assertQueued(App\Mail\JiriCreatedMail::class);

});


it('fills correctly the email with the values of the created Jiri', function () {


    $jiri = Jiri::factory()->for(User::factory())->create();

    $mail = new \App\Mail\JiriCreatedMail($jiri);

    $mail->assertSeeInHtml($jiri->name);
});


it('sends the email using the configured transport layer', function () {

    $user = User::factory()->create();
    //$this->actingAs($user);
    $jiri = Jiri::factory()->for($user)->create();

    Mail::to($user->email)->send(new \App\Mail\JiriCreatedMail($jiri));

    $response = file_get_contents('http://localhost:8025/api/v1/messages');
    $messages = json_decode($response, true);

    //dump(env('mail_mailer'));
    $this->assertNotEmpty($messages['messages']);
   // dump($messages['messages']);

});
