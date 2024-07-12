<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Travail;
use App\Models\Person;
use Illuminate\Support\Facades\Auth;

class TravauxController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $person = Person::where('userId', $user->id)->first();
        $userType = $person ? $person->type : null;
        $travaux = Travail::all();
        return view('travaux', compact('travaux','userType'));
    }

    public function create()
    {
        return view('travaux.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|string',
        ]);

        Travail::create($request->all());

        return redirect()->route('travaux.index');
    }

    public function edit(Travail $travail)
    {
        return view('travaux.edit', compact('travail'));
    }

    public function update(Request $request, Travail $travail)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|string',
        ]);

        $travail->update($request->all());

        return redirect()->route('travaux.index');
    }

    public function destroy(Travail $travail)
    {
        $travail->delete();

        return redirect()->route('travaux.index');
    }
}
