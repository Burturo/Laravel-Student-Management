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
            $courses = Cour::with('Person:id,firstName')
                ->get();
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
            "insert into courses (displayname, description, type, document, dueDate, idPerson) values (?, ?, ?, ?, ?, ?)",
            [
                $request->name,
                $request->description,
                $request->type,
                $filePath,
                $currentDateTime,
                $user->id
            ]
        );
        // Creating the course
        //  Cour::create([
        //      'name' => $request->name,
        //      'description' => $request->description,
        //      'type' => $request->type,
        //      'document' => $filePath,
        //      'dueDate' => $formattedDate,
        //      'idPerson' => $user->id,
        //  ]);

        // Checking if the course was created
        if ($course) {
            return redirect()->route('courses.index')->with('success', 'Course created successfully.');
        } else {
            return redirect()->route('courses.index')->with('error', 'Failed to create course.');
        }
    }

    public function update(Request $request, Cour $cour)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|string',
        ]);

        $cour->update($request->all());

        return redirect()->route('courses.index');
    }


    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }
}
