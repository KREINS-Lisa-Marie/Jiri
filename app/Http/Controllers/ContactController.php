<?php

namespace App\Http\Controllers;

use App\Enums\ContactRoles;
use App\Http\Requests\StoreContactRequest;
use App\Jobs\ProcessUploadContactAvatar;
use App\Models\Contact;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
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


    public function store(StoreContactRequest $request): RedirectResponse
    {
        // $this->authorize('store', $contact);
        $validated = $request->validated();
        //Gate::authorize('create', $contact);
        //Gate::authorize('store', $contact);
        //if ($request->user()->cannot('store', $contact)) {
        //  abort(403);
        //}
        //dd($validated);

        if ($request->hasFile('avatar')) {

            $new_original_file_name = uniqid() . '.' . config('contactavatar.jpg_image_type');

            $full_path_to_original = Storage::putFileAs(
                    config('contactavatar.originals_path'),
                    $validated['avatar'],
                    $new_original_file_name);
                    $validated['avatar'] = $new_original_file_name;
            if ($full_path_to_original) {
                ProcessUploadContactAvatar::dispatch($full_path_to_original, $new_original_file_name);
            } else {
                $validated['avatar'] = '';
            }
        }
        /*
                    $original_file_name = 'contact_' . uniqid() . '_300x300'.'.'.config('contactsavatar.imagetype');
                    $original_file_path = "contacts/$original_file_name";


                    Storage::disk('public')->put($original_file_path, $image->toString());
                    //dd($path);
                    //dd($path);
                    //$file_name = uniqid('contact_').'.jpg';
                    //$path ="contact/$file_name";
                    //\Storage::disk('public')->put($path, $request->file('avatar'));
                    $validated['avatar'] = $original_file_path;*/
        $contact = auth()->user()->contacts()->create($validated);
        //Contact::create($validated);
        return redirect()->route('contacts.show', $contact /*$contact->id*/);
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
                    'id' => $contact->id,
                    'name' => $validated_data['name'],
                    'email' => $validated_data['email'] === $contact['email'] ? $contact['email'] : $validated_data['email'],
                    'avatar' => $validated_data['avatar'],
                    'user_id' => Auth::user()->id,
                ],
            ],
            'id',
            ['name', 'email', 'avatar']);


        return redirect(route('contacts.show', $contact));
    }
}
