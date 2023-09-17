<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Events/Show',
        [
            'event' => Event::where('is_active', true)->first()
        ]);
    }
}
