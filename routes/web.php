<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ExclusionController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\ProfileController;
use App\Models\Event;
use Illuminate\Foundation\Application;
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

Route::get('/', function () {
    $event = Event::where('is_active', true)->first() ?? null;
    $participants = null;
    if ($event) {
        $participants = $event->participants()->with('links')->get() ?? null;
    }
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login')
        , 'event' => $event
        , 'participants' => $participants
    ]);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // setup event lottery route
    Route::get('events/{event}/lottery', [EventController::class, 'runLottery'])->name('events.lottery');

    Route::resource('links', LinkController::class);
    Route::resource('events', EventController::class);
    Route::resource('exclusions', ExclusionController::class);
    Route::resource('participants', ParticipantController::class);
});

require __DIR__.'/auth.php';
