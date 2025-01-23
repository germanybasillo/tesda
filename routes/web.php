<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssessmentController;
use Illuminate\Support\Facades\Auth;
use App\Models\Assessment;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
	$assessments = Assessment::where('user_id', Auth::id())->get(); // Retrieve assessments for the authenticated user
return view('dashboard', compact('assessments'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home', function () {
	$assessments = Assessment::where('user_id', Auth::id())->get(); // Retrieve assessments for the authenticated user
$assessments = Assessment::all(); // Retrieve all assessments
    return view('home', compact('assessments'));
})->middleware(['auth', 'verified'])->name('home');


Route::get('/applyassessmentschedule', function () {
    return view('applyassessmentschedule');
})->middleware(['auth', 'verified'])->name('applyassessmentschedule');

Route::get('/participant', function () {
    return view('participant');
})->middleware(['auth', 'verified'])->name('participant');

Route::middleware(['auth'])->group(function () {
    Route::get('/assessments/create', [AssessmentController::class, 'create'])->name('assessments.create');
    Route::post('/assessments/store', [AssessmentController::class, 'store'])->name('assessments.store');
    Route::get('/assessments/{assessment}/edit', [AssessmentController::class, 'edit'])->name('assessments.edit');
    Route::put('/assessments/{assessment}', [AssessmentController::class, 'update'])->name('assessments.update');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
