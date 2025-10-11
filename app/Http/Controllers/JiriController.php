<?php

namespace App\Http\Controllers;

use App\Enums\ContactRoles;
use App\Models\Contact;
use App\Models\Jiri;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class JiriController extends Controller
{
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required',
            'date' => 'required|date',
            'description' => 'nullable',
            'projects.*' => 'nullable|integer',
            'contacts.*' => 'nullable|array',
            'contacts.*.role' => Rule::enum(ContactRoles::class),
        ]);

        $jiri = auth()->user()->jiris()->create($validated);

        //  kann auch private f° damit machen
        if (!empty($validated['projects'])) {
            $jiri->projects()->attach($validated['projects']);
        }

        /*        if (!empty($validated['user_id'])) {
                    $jiri->users()->attach($validated['user_id']);
                }*/

        //  kann auch private f° damit machen
        if (!empty($validated['contacts'])) {
            foreach ($validated['contacts'] as $id => $contact) {
                $jiri
                    ->contacts()
                    ->attach(
                        $id,
                        ['role' => $contact['role']]
                    );
            }
        }

        return redirect(route('jiris.index'));
        // to_route('jiris.index');
    }

    public function index()
    {
        $jiris = Jiri::all();
        $users = User::all();

        foreach ($users as $user) {
            if ($user = auth()->user()) {
                return View('jiris.index', compact('jiris', 'user'));
            }
        }
    }

    public function show(Jiri $jiri)
    {
        $user = Auth::user();

        if ($jiri->user_id === $user->id) {
            return View('jiris.show', compact('jiri', 'user'));
        }

    }

    public function create()
    {

        $contacts = Contact::all();

        return view('jiris.create', compact('contacts'));

    }

    public function edit(Jiri $jiri)
    {

        $user = Auth::user();

        return view('jiris.edit', compact('jiri'));
    }

    public function update(Jiri $jiri)
    {
        $user = Auth::user();

        return view('jiris.show', compact('jiri'));
    }
}
