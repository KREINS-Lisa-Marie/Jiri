<?php

namespace App\Listeners;

use App\Events\JiriCreatedEvent;
use App\Mail\JiriCreatedMail;
use App\Models\Jiri;
use Illuminate\Support\Facades\Mail;

class SendJiriCreatedEmailListener
{
    public function __construct()
    {
    }

    public function handle(JiriCreatedEvent $event): void
    {
        Mail::to(request()->user())->queue(new JiriCreatedMail($event->jiri));         // event a jiri dedans          queue attend un mailable
    }
}
