<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Travail;
use App\Models\Person;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TravauxController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $person = Person::where('userId', $user->id)->first();
        $userType = $person ? $person->type : null;

        if ($userType === 'Professeur') {
            $travaux = Travail::with('Person:id,firstName')
                ->get();
        } else {
            $travaux = DB::select("select * from travaux");
        }
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
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,png',
        ]);

        //Travail::create($request->all());
        $user = Auth::user();
        // Handling file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');
        } else {
            $filePath = null;
        }

        // Getting the current date and formatting it
        $currentDateTime = now();
        $formattedDate = $currentDateTime->format('d-m-Y H:i:s');

        DB::statement(
            "insert into travaux (displayname, description, type, document, dueDate, idPerson) values (?, ?, ?, ?, ?, ?)",
            [
                $request->name,
                $request->description,
                $request->type,
                $filePath,
                $currentDateTime,
                $user->id
            ]
        );

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
        //$travail = Travail::findOrFail($travail);
        //DB::statement('delte from travaux where code=?', [$travail]);
        $travail->delete();

        return redirect()->route('travaux.index')->with('success', 'Travail deleted successfully.');
    }
}
