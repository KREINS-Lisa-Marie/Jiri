<?php

namespace App\Http\Controllers;

use App\Models\Jiri;

class JiriController extends Controller
{
    public function store()
    {
        Jiri::create(request()->all());

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
}
