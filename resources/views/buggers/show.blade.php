@extends('layouts.app')

@section('content')
    <article class="message is-info">
        <div class="message-header">
            <div class="level">
                <div class="level-left">
                    <span class="icon"><i class="{{ $bugger['level_icon'] }}"></i></span>
                    <strong>{{ $bugger['error_class'] }}</strong>
                </div>
                <div class="level-right">
                    <button class="delete"></button>
                </div>
            </div>
        </div>
        <div class="message-body">
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
            @if(sizeof($bugger['trace']) > 0)
                <table class="table is-narrow">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Stack Trace</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($bugger['trace'] as $line)
                        <tr>
                            <th>{{ $loop->index + 1 }}</th>
                            <td><small>{{ $line }}</small></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
            <small>{{ $bugger['date'] }}</small>
        </div><!-- message-body -->
    </article>
@endsection
