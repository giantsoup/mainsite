<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Events/Index',
            [
                'events' => Event::orderBy('name', 'desc')->get()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Events/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            // Add more validation rules for other fields if needed
        ]);

        // Find the active event
        $activeEvent = Event::active()->first();

        // Create a new event
        $event = Event::create($validatedData);

        // Remove active from current active event and copy over its participants to our new event
        if ($activeEvent) {
            $event->participants()->sync($activeEvent->participants);
            $activeEvent->update(['is_active' => false]);
        }

        // Return inertia view for the newly created event
        return redirect()->route('events.show', ['event' => $event->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return Inertia::render('Events/Show',
            [
                'event' => $event
                , 'participants' => $event->participants()->with('links')->get()
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }
}
