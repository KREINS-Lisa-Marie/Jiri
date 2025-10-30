<?php

namespace App\Http\Controllers;

use App\Enums\ContactRoles;
use App\Events\JiriCreatedEvent;
use App\Http\Requests\StoreJiriRequest;
use App\Mail\JiriCreatedMail;
use App\Models\Contact;
use App\Models\Jiri;
use App\Models\Project;
use App\Models\User;
use App\Observers\JiriObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


//#[ObservedBy([JiriObserver::class])]

class JiriController extends Controller
{
    use AuthorizesRequests;

    public function store(StoreJiriRequest $request, Jiri $jiri)
    {
        // $this->authorize('store', $jiri);
        $validated = $request->validated();

        $jiri = auth()->user()->jiris()->create($validated);

        //$jiri = request()->user()->jiris()->create();

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
        //\Mail::to($request->user())->send(new JiriCreatedMail($jiri));
        //\Mail::to($request->user())->queue(new JiriCreatedMail($jiri));


        //event(new JiriCreatedEvent($jiri));

        return redirect(route('jiris.index'));
        // to_route('jiris.index');
    }


    public function index(Request $request)
    {
        /*        $jiris = Jiri::all();
                $users = User::all();*/
        /*foreach ($users as $user) {
            if ($user != auth()->user()) {
                abort(403);
            }
        }*/
        $user = Auth::user();

        //$jiris = $user->jiris;
        /*$jiris = $user->jiris()->with(['attendances', 'projects', 'user'])
            ->get();*/

        //      trier
        $sort = $request->get('sort', 'name'); // default sort column
        $order = $request->get('order', 'asc'); // default order

        $validSorts = ['name', 'date'];
        if (!in_array($sort, $validSorts)) {
            $sort = 'name';
        }

        /*        $jiris = $user->jiris()
                    ->orderBy($sort, $order)
                    ->with(['projects', 'evaluated', 'evaluators'])
                    ->get();*/
        /*      $jiris = $user->jiris()
                  ->orderBy($sort, $order)
                  ->with(['projects', 'evaluated', 'evaluators'])
                  ->paginate(3);*/
/*        $jiris = $user->jiris()
            ->orderBy($sort, $order)
            ->with(['projects', 'evaluated', 'evaluators'])
            ->paginate($perPage = 3, $columns = ['*'], $pageName = 'jiris'
            );*/
        //$jiris->paginate(3);

        $jiris = $user->jiris()
            ->with(['projects', 'evaluated', 'evaluators'])     //fait du eager loading

            ->when($request->project_id, function($query) use ($request) {
                $query->whereHas('projects', function($q) use ($request) {
                    $q->where('projects.id', $request->project_id);
                });
            })
            ->when($request->start_date, fn($query) => $query->whereDate('date', '>=', $request->start_date))
            ->when($request->end_date, fn($query) => $query->whereDate('date', '<=', $request->end_date))
            ->orderBy($sort, $order)            //trier
            ->paginate(3, ['*'], 'jiris');          //paginer


        //recuperer les projets et contacts de mon user
        $projects = $user->projects()->get();
        $contacts = $user->contacts()->get();

        //recuperer les jiris de mon user
        $jirinumber = $user->jiris();


        /*$all_jiris = Jiri::with('projects')->get();
        //dd($all_jiris);
        foreach ($all_jiris as $jiri) {
            if ($request->filled('project_id')) {
                $all_jiris->whereHas('projects', function ($q) use ($request) {
                    $q->where('projects.id', $request->project_id);
                });

            }
            $filtered_jiris = $jiri->get();
        }*/
        //$filterevaluated = $contacts->where('role', 'evaluator');
        //  $activeUsers = $contacts->where('role', 'evaluator');


        return View('jiris.index', compact('jiris', 'user', 'order', 'sort', 'projects', 'contacts', 'jirinumber'));
    }

    public function show(Jiri $jiri, Request $request)
    {
        $user = Auth::user();

        if ($jiri->user_id !== $user->id) {
            abort(403);
        }


        $sort = $request->get('sort', 'name'); // default sort column
        $order = $request->get('order', 'asc'); // default order

        $validSorts = ['name', 'email'];
        if (!in_array($sort, $validSorts)) {
            $sort = 'name';
        }

        $contacts = $user->contacts()
            ->orderBy($sort, $order)
            ->get();


        return View('jiris.show', compact('jiri', 'user', 'contacts'));
    }

    public function create()
    {
        $user = Auth::user();
        $contacts = $user->contacts;
        $projects = $user->projects;

        //dd($contacts);
        // $contacts = Contact::all();
        // $projects = Project::all();

        return view('jiris.create', compact('contacts', 'projects'));

    }

    public function edit(Jiri $jiri)
    {
        // juste ce quil y a pour le user connecté
        $user = Auth::user();
        $contacts = $user->contacts;
        $projects = $user->projects;

        /*ça c'est tous les utilisateurs
         * $contacts = Contact::all();
        $projects = Project::all();*/

        return view('jiris.edit', compact('jiri', 'projects', 'contacts'));
    }

    public function update(Request $request, Jiri $jiri)
    {
        // $this->authorize('update', $jiri);
        /*        if ($request->user()->cannot('update', $jiri)) {
                    abort(403);
                }
                $this->authorize('update', $jiri);
                $user = Auth::user();*/

        // validation
        $validated_data = $request->validate([
            'name' => 'required',
            'date' => 'required|date',
            'description' => 'nullable',
            'projects.*' => 'nullable|integer',
            'contacts.*' => 'nullable|array',
            'contacts.*.role' => Rule::enum(ContactRoles::class),
        ]);

        // update et insert
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

        return redirect(route('jiris.show', $jiri));
    }
}
