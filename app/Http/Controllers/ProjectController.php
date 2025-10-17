<?php

namespace App\Http\Controllers;

use App\Enums\ContactRoles;
use App\Http\Requests\StoreProjectRequest;
use App\Models\Project;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    use AuthorizesRequests;
    public function index() {

        $projects = Project::all();

        return view('projects.index', compact('projects'));
    }

    public function store(StoreProjectRequest $request, Project $project)
    {
        $this->authorize('store', $project);
        //Project::create(request()->all());

        $validated = $request->validated();

        Auth::user()->projects()->create($validated);

        return redirect()->route('projects.index');
    }

    public function show(Project $project)
    {
        //$projects = Project::all();

        return View('projects.show', compact('project'));
    }
    public function create()
    {
        return view('projects.create');
    }
}
