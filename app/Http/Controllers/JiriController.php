<?php

namespace App\Http\Controllers;

use App\Enums\ContactRoles;
use App\Models\Attendance;
use App\Models\Contact;
use App\Models\Jiri;
use Illuminate\Http\Request;
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

        $jiri = Jiri::create($validated);

        //  kann auch private f° damit machen
        if (!empty($validated['projects'])) {
            $jiri->projects()->attach($validated['projects']);
        }

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

        return View('jiris.index', compact('jiris'));
    }

    public function show(Jiri $jiri)
    {

        $jiris = Jiri::all();

        return View('jiris.show', compact('jiris'));
    }

    public function create()
    {

        $contacts = Contact::all();
        return view('jiris.create', compact('contacts'));

    }
}
