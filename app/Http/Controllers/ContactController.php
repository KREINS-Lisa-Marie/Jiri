<?php

namespace App\Http\Controllers;

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

class ContactController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        //$contacts = Auth::user()->contacts;
        // dd($contacts);
        //$contacts->paginate($perPage = 3, $columns = ['*'], $pageName = 'contacts');


        $user = Auth::user();

        $sort = $request->get('sort', 'name'); // default sort column
        $order = $request->get('order', 'asc'); // default order

        $validSorts = ['name', 'email'];
        if (!in_array($sort, $validSorts)) {
            $sort = 'name';
        }

        $contacts = $user->contacts()
            ->orderBy($sort, $order)
            ->paginate($perPage = 3, $columns = ['*'], $pageName = 'contacts'
            );

    /*    $contacts = Auth::user()->contacts()
            ->paginate($perPage = 3, $columns = ['*'], $pageName = 'contacts'
        );*/


        return view('contacts.index', compact('contacts', 'sort', 'order'));
    }

    public function store(StoreContactRequest $request): RedirectResponse
    {

        // $this->authorize('store', $contact);
        // Gate::authorize('create', $contact);
        // Gate::authorize('store', $contact);
        // if ($request->user()->cannot('store', $contact)) {
        //  abort(403);
        // }
        // dd($validated);
        $validated = $request->validated();

        //if ($validated['avatar']) {
        if ( $request->hasFile('avatar')) {
            $new_original_file_name = uniqid().'.'.config('contactavatar.jpg_image_type');

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
                    dd($path);
                    $file_name = uniqid('contact_').'.jpg';
                    $path ="contact/$file_name";
                    Storage::disk('public')->put($path, $request->file('avatar'));
                    $validated['avatar'] = $original_file_path;
        */
        $contact = auth()->user()->contacts()->create($validated);

        // Contact::create($validated);
        return redirect()->route('contacts.show', $contact /* $contact->id */);
    }

    public function show(Contact $contact)
    {
        // $contacts = auth()->user()->contacts;
        return View('contacts.show', compact(/* 'contacts', */ 'contact'));
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
        // validation
        $validated_data = $request->validate([
            'name' => 'required|string',
            'email' => [
                'required',
                'email',
                Rule::unique('contacts')->ignore($contact->id)
                // email aus tabelle contacts ausser bei diesem kontakt mit contact-id
                //Gibt es schon jemanden mit der E-Mail ... aber nicht den mit der id $contact->id?
            ],
            'avatar' => 'nullable|image',
        ]);


        //make diff avatar sizes
        if ( $request->hasFile('avatar')) {
            $new_original_file_name = uniqid() . '.' . config('contactavatar.jpg_image_type');

            $full_path_to_original = Storage::putFileAs(
                config('contactavatar.originals_path'),
                $validated_data['avatar'],
                $new_original_file_name);

            $validated_data['avatar'] = $new_original_file_name;

            if ($full_path_to_original) {
                ProcessUploadContactAvatar::dispatch($full_path_to_original, $new_original_file_name);
            } else {
                $validated_data['avatar'] = '';
            }
        }

        
        // update et insert
        $contact->upsert(
            [
                [
                    'id' => $contact->id,
                    'name' => $validated_data['name'],
                    'email' => $validated_data['email'],
                    'avatar' => $validated_data['avatar']?? null,
                    'user_id' => Auth::user()->id,
                ],
            ],
            'id',
            ['name', 'email', 'avatar', 'user_id', 'updated_at']);

        return redirect(route('contacts.show', $contact));
    }
}
