@extends('layouts.panel')
@section('panel-heading')
    Buggers
@endsection

@section('panel-tabs')
    <a class="{{ request()->query('level_name') === null ? 'is-active' : '' }}"
       href="{{ route('buggers.index') }}">All
    </a>
    <a class="{{ request()->query('level_name') === 'ERROR' ? 'is-active' : '' }}"
       href="{{ route('buggers.index', ['level_name' => 'ERROR']) }}">Errors
    </a>
    <a class="{{ request()->query('level_name') === 'WARNING' ? 'is-active' : '' }}"
       href="{{ route('buggers.index', ['level_name' => 'WARNING']) }}">Warnings
    </a>
@endsection

@section('panel-content')
    @foreach($buggers as $bugger)
        <div class="{{ "box " . $bugger['level_name']}}">
            <article class="media">
                <div class="media-left">
                    <span class="icon is-medium"><i class="fa fa-warning"></i></span>
                </div>
                <div class="media-content">
                    <div class="content">
                        <div class="level">
                            <div class="level-left">
                                <div class="level-item">
                                    <strong>{{ $bugger['error_class'] }}</strong>
                                </div>
                                <div class="level-item">
                                    <small>{{ $bugger['file'] }}</small>
                                </div>
                            </div>
                            <div class="level-right">
                                <div class="level-item">
                                    {{ $bugger['date'] }}
                                </div>
                            </div>
                        </div>
                        <p>
                            {{ $bugger['message'] }}
                        </p>
                    </div>
                </div>
            </article>
        </div>
    @endforeach
@endsection
