@extends('layouts.app')

@section('content')
    <div class="{{ $bugger['level_name'] }}">
        <article class="message">
            <div class="message-header log-header">
            <div class="level">
                <div class="level-left">
                    <div class="level-item">
                        <span class="icon level-icon"><i class="{{ $bugger['level_icon'] }}"></i></span>
                    </div>
                    <div class="level-item error-name">
                        {{ $bugger['error_class'] }}
                    </div>
                </div>
                <div class="level-right">
                    <div class="level-item">
                        <small>{{ $bugger['date'] }}</small>
                    </div>
                    <div class="level-item">
                        <button class="delete"></button>
                    </div>
                </div>
            </div>
        </div>
            <div class="message-body log-body">
            <div class="level">
                <div class="level-left">
                    <div class="level-item">
                        {{ $bugger['message'] }}
                    </div>
                </div><!-- level-left -->
                <div class="level-right">
                    @if($bugger['file'] !== "" && $bugger['file'] !== null)
                        <div class="level-item">
                            <strong>{{$bugger['file']}}</strong>
                        </div>
                    @endif
                </div><!-- level-right -->
            </div><!-- level -->
            <br>

                {{-------------------------------------------------------}}
                {{-------------------- TRACE TABLE ----------------------}}
                {{-------------------------------------------------------}}
            @if(sizeof($bugger['trace']) > 0)
                <table class="table is-narrow">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Stack Trace</th>
                        </tr>
                    </thead>
                    <tbody>
                    {{--If file is given, start trace table with file name--}}
                    @if($bugger['file'] !== null && $bugger['file'] !== "")
                        <tr>
                            <th>0</th>
                            <td>{{ $bugger['file'] }}</td>
                        </tr>
                    @endif
                    @foreach($bugger['trace'] as $line)
                        <tr>
                            <th>{{ $loop->index + 1 }}</th>
                            <td><small>{{ $line }}</small></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div><!-- message-body -->
    </article>
    </div>
@endsection
