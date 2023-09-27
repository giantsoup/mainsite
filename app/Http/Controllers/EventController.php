<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
                , 'matches' => $event->matches()->with('participant', 'matchedParticipant')->get()
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

    public static function rerunLottery(Event $event)
    {
        // delete all event matches and then call runLottery
        $event->matches()->delete();
        self::runLottery($event);

        return back();
    }

    public static function runLottery(Event $event)
    {
        // setup event matches so that we can track who has been selected as we go
        $event_matches = collect();

        // get all event participants
        $participants = $event->participants()->get();

        // get the previous 3 events
        $previousEvents = Event::where('id', '!=', $event->id)->orderBy('name', 'desc')->limit(3)->get();

        // for each participant, use their exclusions and previous matches to find a match
        foreach ($participants as $participant) {
            // get participant exclusions
            $exclusions = $participant->exclusions()->get();

            // get participant previous matches
            $previousMatches = $participant->eventMatches()->whereIn('event_id', $previousEvents->pluck('id'))->get();

            // get all participants that are not excluded and have not been matched over the past 3 years and have not already been selected in this lottery
            $availableParticipants = $participants
                ->where('id', '!=', $participant->id)
                ->whereNotIn('id', $exclusions->pluck('excluded_participant_id')->toArray())
                ->whereNotIn('id', $previousMatches->pluck('matched_participant_id')->toArray())
                ->whereNotIn('id', $event_matches->pluck('matched_participant_id')->toArray());

            // if there are available participants
            if ($availableParticipants->isNotEmpty()) {
                // create an event match for this participant
                $eventMatch = $event->matches()->create([
                    'participant_id' => $participant->id
                    , 'matched_participant_id' => $availableParticipants->random()->id
                ]);

                // add this event match to the event matches array
                $event_matches->push($eventMatch);
            } else {
                // if there are no available participants, we have a problem
                Log::error('No available participants for participant ' . $participant->id);
            }
        }

        return back();
    }
}
