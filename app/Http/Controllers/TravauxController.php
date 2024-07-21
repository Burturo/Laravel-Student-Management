<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Travail;
use App\Models\Person;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TravauxController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $person = Person::findOrFail($user->id);
        $userType = $person ? $person->type : null;
        if ($userType === 'Professeur') {
            $travaux = Travail::join('people', 'travaux.id_person', '=', 'people.id')
                ->select('travaux.*', 'people.firstname')
                ->get();
        } else {
            $travaux = DB::select("select * from travaux where id_person=$user->id");
        }
        return view('travaux', compact('travaux','userType'));
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
        // if ($request->hasFile('file')) {
        //     $file = $request->file('file');
        //     $fileName = time() . '_' . $file->getClientOriginalName();
        //     $filePath = $file->storeAs('uploads', $fileName, 'public');
        // } else {
        //     $filePath = null;
        // }
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('uploads', 'public');
        }
        // Getting the current date and formatting it
        $currentDateTime = now();
        $formattedDate = $currentDateTime->format('d-m-Y H:i:s');

        DB::statement(
            "insert into travaux (displayname, description, type, document, due_date, id_person) values (?, ?, ?, ?, ?, ?)",
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


    public function update(Request $request,$id)
    {
        $travail = Travail::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,png',
        ]);

        $filePath = $travail->document;
        if ($request->hasFile('file')) {
            // Supprimez l'ancien fichier s'il existe
            if ($filePath) {
                Storage::disk('public')->delete($filePath);
            }
            $filePath = $request->file('file')->store('uploads', 'public');
        }

        // Préparation des données pour la mise à jour
        $updated = DB::table('travaux')
                    ->where('id', $travail->id)
                    ->update([
                        'displayname' => $request->input('name'),
                        'description' => $request->input('description'),
                        'type' => $request->input('type'),
                        'document' => $filePath,
                        'updated_at' => now(),
                    ]);

        return redirect()->route('travaux.index');
    }

    public function delete($id)
    {
        $travail = Travail::findOrFail($id);
        $travail = DB::table('travaux')->where('id', $travail->id)->delete();
        return redirect()->route('travaux.index')->with('success', 'Travail deleted successfully.');
    }

    public function download($id)
    {
        $travail = Travail::findOrFail($id);
        if ($travail->document) {
            $filePath = storage_path('app/' . $travail->document);

            if (file_exists($filePath)) {
                return response()->download($filePath, basename($filePath));
            } else {
                return redirect()->route('travaux.index')->with('error', 'File not found.');
            }
        } else {
            return redirect()->route('travaux.index')->with('error', 'No document associated with this travail.');
        }
    }
}
