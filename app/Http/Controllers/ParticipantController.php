<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Participant;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Participants/Index', [
            'participants' => Participant::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Participants/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'first_name' => 'required|string|max:255'
            , 'last_name' => 'required|string|max:255'
            , 'email' => 'string|max:255'
            , 'phone' => 'string'
            , 'event_id' => 'integer|nullable'
        ]);

        $participant = Participant::create($validated_data);

        if ($validated_data['event_id']) {
            // add participant to the event from which it was created
            $event = Event::find($validated_data['event_id']);
            $event->participants()->attach($participant);
        }

        if ($request->all()['redirect'] === 'events.show') {
            // return back to event from which the participant was created
            return to_route('events.show', ['event' => $validated_data['event_id']]);
        }
        if ($request->all()['redirect'] === 'participants.index') {
            // return back to participants index
            return to_route('participants.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Participant $participant)
    {
        return Inertia::render('Participants/Show', [
            'participant' => $participant->load('links')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Participant $participant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Participant $participant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Participant $participant)
    {
        //
    }
}
