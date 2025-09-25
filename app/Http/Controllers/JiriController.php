<?php

namespace App\Http\Controllers;

use App\Models\Jiri;
use Illuminate\Http\Request;

class JiriController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'date' => 'required|date',
            'description' => 'nullable',
        ]);

        Jiri::create($validated);

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

        return view('jiris.create');

    }
}
