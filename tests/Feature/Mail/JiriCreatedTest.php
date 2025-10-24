<?php

use App\Events\JiriCreatedEvent;
use App\Listeners\SendJiriCreatedEmailListener;
use App\Models\Jiri;
use App\Models\User;
use function Pest\Laravel\post;
use \Illuminate\Support\Facades\{Event, Mail};

it("fires an event asking to queue an email to send to the author after the creation of a Jiri", function (){

     Event::fakeExcept('eloquent.created: App\Models\Jiri');          //désactive les écouteurs d'evenements

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
    \Illuminate\Support\Facades\Mail::fake();

    Event::fake(['eloquent.created: App\Models\jiri']);

    $jiri = Jiri::factory()->for(User::factory())->create();

    $mail = new \App\Mail\JiriCreatedMail($jiri);

    $mail->assertSeeInHtml($jiri->name);
});


it('sends the email using the configured transport layer', function () {

    Event::fake(['eloquent.created: App\Models\jiri']);
    \Illuminate\Support\Facades\Mail::fake();

    $user = User::factory()->create();
    //$this->actingAs($user);
    $jiri = Jiri::factory()->for($user)->create();

    try {
        Mail::to($user)->send(new \App\Mail\JiriCreatedMail($jiri));
    }catch (Exception $e){
        test()->fail($e->getMessage());
    }

    //Mail::to($user->email)->send(new \App\Mail\JiriCreatedMail($jiri));

    $response = file_get_contents('http://localhost:8025/api/v1/messages');
    $messages = json_decode($response, true);

    //dump(env('mail_mailer'));
    $this->assertNotEmpty($messages['messages']);
   // dump($messages['messages']);

});


it('queues the sending of the jiri created mail after the jiri created event has been fired', function () {

    \Illuminate\Support\Facades\Mail::fake();
     $jiri = Jiri::factory()->for(User::factory())->create();

    event(new JiriCreatedEvent($jiri));

    Mail::assertQueued(App\Mail\JiriCreatedMail::class);

});
