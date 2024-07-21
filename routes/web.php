<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\TravauxController;
use App\Http\Controllers\DashboardController;

// Route par défaut
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');

// Routes d'authentification
Route::post('/login', [AuthController::class, 'login'])->name('authentification');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('registration');
Route::post('/dashboard', [AuthController::class, 'logout'])->name('logout')->middleware('checkUserType');

// Route pour le tableau de bord
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    // Routes pour les cours
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::post('/courses/create', [CourseController::class, 'store'])->name('courses.store');
    Route::put('/courses/{id}', [CourseController::class, 'update'])->name('courses.update');
    Route::delete('/courses/{id}', [CourseController::class, 'delete'])->name('courses.destroy');
    Route::get('/courses/{id}', [CourseController::class, 'download'])->name('courses.download');
});

// Routes protégées par authentification
Route::middleware('auth')->group(function () {
    // Routes pour les travaux

    Route::get('/travaux', [TravauxController::class, 'index'])->name('travaux.index');
    Route::post('/travaux/create', [TravauxController::class, 'store'])->name('travaux.store');
    Route::put('/travaux/{id}', [TravauxController::class, 'update'])->name('travaux.update');
    Route::delete('/travaux/{id}', [TravauxController::class, 'delete'])->name('travaux.destroy');
    Route::get('/travaux/{id}', [TravauxController::class, 'download'])->name('travaux.download');

});
