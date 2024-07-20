<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Person;
use App\Models\Cour;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $person = Person::where('userId', $user->id)->first();
        $userType = $person ? $person->type : null;
        if ($userType === 'Etudiant') {
            $courses = Cour::join('people', 'courses.id_person', '=', 'people.id')
                ->select('courses.*', 'people.firstname')
                ->get();
            // $courses = DB::select('
            //         select c.*, p.firstname
            //         from courses c, people p where c.id_person = p.id
            //     ');
        } else {
            $courses = DB::select("select * from courses");
        }
        return view('course', compact('courses','userType'));
    }



    public function store(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,png',
        ]);

        // Handling file upload
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('uploads', 'public');
        }

        // Getting the current date and formatting it
        $currentDateTime = now();
        $formattedDate = $currentDateTime->format('d-m-Y H:i:s');

        DB::statement(
            "insert into courses (displayname, description, type, document, due_date, id_person) values (?, ?, ?, ?, ?, ?)",
            [
                $request->name,
                $request->description,
                $request->type,
                $filePath,
                $currentDateTime,
                $user->id
            ]
        );
        return redirect()->route('courses.index');
    }

    public function update(Request $request,Cour $cour)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,png',
        ]);

        $filePath = $cour->document;
        if ($request->hasFile('file')) {
            // Supprimez l'ancien fichier s'il existe
            if ($filePath) {
                Storage::disk('public')->delete($filePath);
            }
            $filePath = $request->file('file')->store('uploads', 'public');
        }

        // Préparation des données pour la mise à jour
        $updated = DB::table('courses')
                    ->where('id', $cour->id)
                    ->update([
                        'displayname' => $request->input('name'),
                        'description' => $request->input('description'),
                        'type' => $request->input('type'),
                        'updated_at' => now(),
                    ]);
        return redirect()->route('courses.index');
    }


    public function delete(Cour $cour)
    {
        $cour = DB::table('courses')->where('id', $cour->id)->delete();
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }

    public function download(Cour $cour)
    {
        //$travail = Travail::findOrFail($id);

        if ($cour->document) {
            $filePath = storage_path('app/' . $cour->document);

            if (file_exists($filePath)) {
                return response()->download($filePath, basename($filePath));
            } else {
                return redirect()->route('courses.index')->with('error', 'File not found.');
            }
        } else {
            return redirect()->route('courses.index')->with('error', 'No document associated with this travail.');
        }
    }
}
