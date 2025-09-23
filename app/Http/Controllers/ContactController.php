<?php

namespace App\Http\Controllers;

use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {

    }

    public function store()
    {
        Contact::create(request()->all());
        return redirect()->route('contacts.index');
    }

    public function show(Contact $contact)
    {
        $contacts = Contact::all();
        return View('contacts.show', compact('contacts'));
    }

}
