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
Route::post('/dashboard', [AuthController::class, 'logout'])->name('logout');

// Route pour le tableau de bord
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Routes pour les cours
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::post('/courses/create', [CourseController::class, 'create'])->name('courses.store');
    Route::post('/courses/{id}', [CourseController::class, 'update'])->name('courses.update');
    Route::delete('/courses/{id}', [CourseController::class, 'delete'])->name('courses.destroy');
});

// Routes protégées par authentification
Route::middleware('auth')->group(function () {
    // Routes pour les travaux
    Route::get('/travaux', [TravauxController::class, 'index'])->name('travaux.index');
    //Route::get('/travaux/create', [TravauxController::class, 'create'])->name('travaux.create');
    Route::post('/travaux/create', [TravauxController::class, 'create'])->name('travaux.store');
    //Route::get('/travaux/{travail}/edit', [TravauxController::class, 'edit'])->name('travaux.edit');
    Route::post('/travaux/{id}', [TravauxController::class, 'update'])->name('travaux.update');
    Route::delete('/travaux/{id}', [TravauxController::class, 'delete'])->name('travaux.destroy');


});
