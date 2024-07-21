<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next): Response
    {
        // Vérifiez si l'utilisateur est authentifié
        if (!Auth::check()) {
            return redirect('/'); // Redirige vers la page de connexion si non authentifié
        }

        $user = Auth::user();

        // Vérifiez si le userType est null
        if (is_null($user->userType)) {
            return redirect('/'); // Redirige vers la page de connexion si userType est null
        }

        return $next($request);
    }
}

