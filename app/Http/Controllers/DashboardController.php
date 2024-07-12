<?php

namespace App\Http\Controllers;

use App\Models\Cour;
use App\Models\Travail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $reporting = [
            'totalCourseCount' => Cour::count(),
            'totalTravauxCount' => Travail::count(),
            'totalUserCount' => User::count(),
        ];

        if ($user->userType === 'Etudiant') {
            $reporting['travauxCountByUser'] = Travail::where('idPerson', $user->id)->count();
        } else {
            $reporting['courseCountByUser'] = Cour::where('idPerson', $user->id)->count();
        }

        return view('dashboard', compact('user', 'reporting'));
    }
}
