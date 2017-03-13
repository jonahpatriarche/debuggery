@extends('layouts.app')

@section('content-heading')
    <h4>Create Tracker</h4>
@endsection

@section('content')
    @include('partials._errors')
    @include('trackers._form', [
        '_method' => 'POST',
        'route'   => route('trackers.store',['bugger_id' => $bugger_id]),
        'tracker' => $tracker
    ])

@endsection



