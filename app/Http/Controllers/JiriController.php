<?php

namespace App\Http\Controllers;

use App\Enums\ContactRoles;
use App\Http\Requests\StoreJiriRequest;
use App\Models\Contact;
use App\Models\Jiri;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class JiriController extends Controller
{
    use AuthorizesRequests;

    public function store(StoreJiriRequest $request, Jiri $jiri)
    {
       // $this->authorize('store', $jiri);
        $validated = $validated = $request->validated();

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
/*        $jiris = Jiri::all();
        $users = User::all();*/

        /*foreach ($users as $user) {
            if ($user != auth()->user()) {
                abort(403);
            }
        }*/
        $user = Auth::user();

        $jiris =  $user->jiris;


        return View('jiris.index', compact('jiris', 'user'));
    }

    public function show(Jiri $jiri)
    {
        $user = Auth::user();

        if ($jiri->user_id !== $user->id) {
            abort(403);
        }
        return View('jiris.show', compact('jiri', 'user'));
    }

    public function create()
    {
        $user = Auth::user();
        $contacts = $user->contacts();
        $projects = $user->projects();

        //$contacts = Contact::all();
        //$projects = Project::all();

        return view('jiris.create', compact('contacts', 'projects'));

    }

    public function edit(Jiri $jiri)
    {
        // juste ce quil y a pour le user connecté
        $user = Auth::user();
        $contacts = $user->contacts();
        $projects = $user->projects();


        /*ça c'est tous les utilisateurs
         * $contacts = Contact::all();
        $projects = Project::all();*/

        return view('jiris.edit', compact('jiri', 'projects', 'contacts'));
    }

    public function update(Request $request, Jiri $jiri)
    {
        //$this->authorize('update', $jiri);
/*        if ($request->user()->cannot('update', $jiri)) {
            abort(403);
        }
        $this->authorize('update', $jiri);
        $user = Auth::user();*/

        //validation
        $validated_data = $request->validate([
            'name' => 'required',
            'date' => 'required|date',
            'description' => 'nullable',
            'projects.*' => 'nullable|integer',
            'contacts.*' => 'nullable|array',
            'contacts.*.role' => Rule::enum(ContactRoles::class),
        ]);


       //update et insert
        $jiri->upsert(
            [
                [
                    'id' => $jiri->id,
                    'user_id' => Auth::user()->id,
                    'name' => $validated_data['name'],
                    'date' => $validated_data['date'],
                    'description' => $validated_data['description'],
                ],
            ],
            'id',
            ['name', 'description', 'date']);


        return view('jiris.show', compact('jiri'));
    }
}
