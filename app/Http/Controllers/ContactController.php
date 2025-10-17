<?php

namespace App\Http\Controllers;

use App\Enums\ContactRoles;
use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Laravel\Facades\Image;

;

class ContactController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $contacts = Auth::user()->contacts;
        //dd($contacts);

        return view('contacts.index', compact('contacts'));
    }


    public function store(StoreContactRequest $request, Contact $contact)
    {
        $this->authorize('store', $contact);
        $validated = $request->validated();
        //Gate::authorize('create', $contact);
        //Gate::authorize('store', $contact);
        //if ($request->user()->cannot('store', $contact)) {
        //  abort(403);
        //}
        //dd($validated);

        if ($request->hasFile('avatar')) {
            $image = Image::read($validated['avatar'])
                ->resize(300, 300)
                ->toJpeg(80);   // compression %

            $file_name = 'contact_' . uniqid() . '_300x300'.'.'.config('contactsavatar.imagetype');
            $path = "contacts/$file_name";


            Storage::disk('public')->put($path, $image->toString());
            //dd($path);
            //dd($path);
            //$file_name = uniqid('contact_').'.jpg';
            //$path ="contact/$file_name";
            //\Storage::disk('public')->put($path, $request->file('avatar'));
            $validated['avatar'] = $path;
        }
        $contact = auth()->user()->contacts()->create($validated);
        //Contact::create($validated);
        return redirect()->route('contacts.show', compact('contact')/*$contact->id*/);
    }


    public function show(Contact $contact)
    {
        //$contacts = auth()->user()->contacts;
        return View('contacts.show', compact(/*'contacts',*/ 'contact'));
    }

    public function create()
    {
        return view('contacts.create');
    }


    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact'));
    }


    public function update(Contact $contact, Request $request)
    {
        //validation
        $validated_data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|unique:contacts',
            'avatar' => 'nullable|image',
        ]);


        //update et insert
        $contact->upsert(
            [
                [
                    'id'=>$contact->id,
                    'name' => $validated_data['name'],
                    'email' => $validated_data['email']=== $contact['email'] ? $contact['email'] : $validated_data['email'],
                    'avatar' => $validated_data['avatar'],
                    'user_id' => Auth::user()->id,
                ],
            ],
            'id',
            ['name', 'email', 'avatar']);


        return view('contacts.show', compact('contact'));
    }
}
