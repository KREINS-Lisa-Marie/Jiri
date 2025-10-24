<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Models\Project;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {

        $user = Auth::user();

        $sort = $request->get('sort', 'name'); // default sort column
        $order = $request->get('order', 'asc'); // default order

        $validSorts = ['name'];
        if (!in_array($sort, $validSorts)) {
            $sort = 'name';
        }

        $projects = $user->contacts()
            ->orderBy($sort, $order)
            ->paginate($perPage = 3, $columns = ['*'], $pageName = 'projects'
            );

        //$projects = Project::all();
        /*$projects = Project::paginate($perPage = 3, $columns = ['*'], $pageName = 'projects'
        );*/

        return view('projects.index', compact('projects', 'sort', 'order'));
    }

    public function store(StoreProjectRequest $request, Project $project)
    {
        //$this->authorize('store', $project);
        // Project::create(request()->all());

        $validated = $request->validated();

         Auth::user()->projects()->create($validated);
        //dd($user);

        return redirect(route('projects.index'));
    }

    public function show(Project $project)
    {
        // $projects = Project::all();

        return View('projects.show', compact('project'));
    }

    public function create()
    {
        return view('projects.create');
    }
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }


    public function update(Project $project, Request $request)
    {
        // validation
        $validated_data = $request->validate([
            'name' => 'required|string',
        ]);

        // update et insert
        $project->upsert(
            [
                [
                    'id' => $project['id'],
                    'name' => $validated_data['name'],
                    'user_id' => Auth::user()->id,
                ],
            ],
            'id',
            ['name']            //colonne a updater
        );

        return redirect(route('projects.update', $project));
    }
}
