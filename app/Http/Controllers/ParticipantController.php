<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Participant;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
            , 'phone' => 'string|max:10'
            , 'event_id' => 'integer'
        ]);

        $participant = Participant::create($validated_data);

        // add participant to the event from which it was created
        $event = Event::find($validated_data['event_id']);
        $event->participants()->attach($participant);

        // return back to event from which the participant was created
        return redirect()->route('events.show', ['event' => $event->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Participant $participant)
    {
        //
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
