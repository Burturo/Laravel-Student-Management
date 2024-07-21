<?php

namespace App\Http\Controllers;

use App\Models\Cour;
use App\Models\Travail;
use App\Models\User;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $person = Person::findOrFail($user->id);
        $reporting = [
            'totalCourseCount' => Cour::count(),
            'totalTravauxCount' => Travail::count(),
            'totalUserCount' => User::count(),
        ];
        if ($person->type === 'Etudiant') {
            $reporting['totalTravauxCount'] = Travail::where('id_person', $user->id)->count();
        } else {
            $reporting['totalCourseCount'] = Cour::where('id_person', $user->id)->count();
        }

        return view('dashboard', compact('user', 'reporting'));
    }
}
