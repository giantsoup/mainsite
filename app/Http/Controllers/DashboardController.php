<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(): Response
    {
        // if there are no events yet, show the events index page
        if (Event::count() === 0) {
            return Inertia::render('Events/Index',
                [
                    'events' => Event::orderBy('name', 'desc')->get()
                ]
            );
        }

        return Inertia::render('Events/Show',
        [
            'event' => Event::where('is_active', true)->first() ?? null
        ]);
    }
}
