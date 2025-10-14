<?php

namespace App\Http\Controllers;

use App\Models\Project;

class ProjectController extends Controller
{
    public function index() {

        $projects = Project::all();

        return view('projects.index', compact('projects'));
    }

    public function store()
    {
        Project::create(request()->all());

        return redirect()->route('projects.index');
    }

    public function show(Project $project)
    {
        $projects = Project::all();

        return View('projects.show', compact('projects'));
    }
}
