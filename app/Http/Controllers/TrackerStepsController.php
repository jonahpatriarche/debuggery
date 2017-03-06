<?php

namespace App\Http\Controllers;

use App\Tracker;
use App\TrackerStep;
use Illuminate\Http\Request;

class TrackerStepsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \App\Tracker $tracker
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Tracker $tracker)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $tracker)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TrackerStep  $trackerStep
     * @return \Illuminate\Http\Response
     */
    public function show(TrackerStep $trackerStep)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TrackerStep  $trackerStep
     * @return \Illuminate\Http\Response
     */
    public function edit(TrackerStep $trackerStep)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TrackerStep  $trackerStep
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TrackerStep $trackerStep)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TrackerStep  $trackerStep
     * @return \Illuminate\Http\Response
     */
    public function destroy(TrackerStep $trackerStep)
    {
        //
    }
}
