<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

;

class ContactController extends Controller
{
    public function index()
    {

    }

    public function store(Request $request)
    {
        $validated = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'avatar' => 'nullable|image',
        ]);

        if ($request->hasFile('avatar')){
            $path = Storage::disk('public')->putFile('contacts', $request->file('avatar'));
            //dd($path);
            //$file_name = uniqid('contact_').'.jpg';
            //$path ="contact/$file_name";
            //\Storage::disk('public')->put($path, $request->file('avatar'));

            $validated['avatar']= $path;
        }


        $contact = auth()->user()->contacts()->create($validated);

        //Contact::create($validated);

        return redirect()->route('contacts.show', compact('contact')/*$contact->id*/);
    }

    public function show()
    {
        $contacts = Contact::all();
        $contact = Contact::latest()->first();

        return View('contacts.show', compact('contacts', 'contact'));
    }

    public function create()
    {
        return view('contacts.create');
    }


}
