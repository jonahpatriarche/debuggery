<?php

namespace App\Http\Controllers;

use App\Bugger;
use App\Repositories\TrackerRepositoryInterface;
use App\Tracker;
use App\Transformers\TrackerTransformer;
use Illuminate\Http\Request;

class TrackersController extends Controller
{

    /**
     * @var \App\Repositories\TrackerRepositoryInterface
     */
    private $trackers;

    /**
     * TrackersController constructor.
     *
     * @param \App\Repositories\TrackerRepositoryInterface $trackers
     * @param \App\Transformers\TrackerTransformer         $transformer
     */
    public function __construct(TrackerRepositoryInterface $trackers, TrackerTransformer $transformer)
    {
        $this->trackers = $trackers;
        $this->transformer = $transformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trackers = $this->trackers->all();

        return $this->transformer->transform($trackers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($bugger_id)
    {
        $tracker = new Tracker();

        return view('trackers.create')
            ->with('bugger_id', $bugger_id)
            ->with('tracker', $tracker);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tracker = $this->trackers->save();

        return $this->transformer->transform($tracker);
    }

    /**
     * Display the specified resource.
     *
     * @param  Tracker $tracker
     * @return \Illuminate\Http\Response
     */
    public function show(Tracker $tracker)
    {
        return $this->transformer->transform($tracker);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
