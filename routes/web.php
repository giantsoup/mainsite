<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ExclusionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\PlaygroundController;
use App\Http\Controllers\ProfileController;
use App\Models\Event;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/secret-santa', [EventController::class, 'currentEvent'])->name('events.currentEvent');

// Login Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Private Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // setup event lottery route
    Route::get('/events/{event}/runLottery', [EventController::class, 'runLottery'])->name('events.runLottery');
    Route::get('/events/{event}/rerunLottery', [EventController::class, 'rerunLottery'])->name('events.rerunLottery');

    Route::resource('links', LinkController::class);
    Route::resource('events', EventController::class);
    Route::resource('exclusions', ExclusionController::class);
    Route::resource('participants', ParticipantController::class);

    // create a simple test page where i can do some real world testing for buttons and method calls
    Route::get('/playground', [PlaygroundController::class, 'index'])->name('playground.index');
    Route::get('/playground/runTest', [PlaygroundController::class, 'runTest'])->name('playground.runTest');
});

require __DIR__.'/auth.php';
