<?php

namespace App\Http\Controllers;

use App\Models\Exclusion;
use App\Models\Participant;
use Illuminate\Http\Request;

class ExclusionController extends Controller
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
            'participant_id' => 'required|integer'
            , 'excluded_participant_id' => 'required|integer'
        ]);

        Exclusion::create($validated_data);

        return to_route('participants.show', ['participant' => $validated_data['participant_id']]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Exclusion $exclusion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exclusion $exclusion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exclusion $exclusion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exclusion $exclusion)
    {
        $participant_id = $exclusion->participant_id;

        $exclusion->delete();

        return to_route('participants.show', ['participant' => $participant_id]);
    }
}
