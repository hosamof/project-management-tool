<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::apiResource('api/projects', ProjectController::class);
    Route::apiResource('api/projects.tasks', TaskController::class);

    Route::get('/projects', function () {
        return view('pages/projects');
    })->name('projects');

    Route::get('/project-detail', function (Request $request) {
        $project = Project::find($request->query('id'));
        return view('pages/project-detail', ['project' => $project]);
    });
});

require __DIR__ . '/auth.php';
