<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TandartsController;
use App\Http\controllers\MondhygienistController;
use App\Http\controllers\PraktijkmanagementController;
use App\Http\controllers\AssistentController;
use App\Http\controllers\PatientController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/tandarts', [TandartsController::class, 'index'])
    ->name('tandarts.index')
    ->middleware(['auth', 'role:admin,tandarts']);

Route::get('/mondhygienist', [MondhygienistController::class, 'index'])
    ->name('mondhygienist.index')
    ->middleware(['auth', 'role:admin,mondhygienist']);
    
Route::get('/praktijkmanagement', [PraktijkmanagementController::class, 'index'])
    ->name('praktijkmanagement.index')
    ->middleware(['auth', 'role:admin,praktijkmanagement']);

Route::get('/assistent', [AssistentController::class, 'index'])
    ->name('assistent.index')
    ->middleware(['auth', 'role:admin,assistent']);

Route::get('/patient', [PatientController::class, 'index'])
    ->name('patient.index')
    ->middleware(['auth', 'role:admin,patient,praktijkmanagement']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
