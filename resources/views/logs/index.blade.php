@extends('layouts.app')

@section('content')

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#wizard-navbar" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Plans</a>
            </div>
            <div class="collapse navbar-collapse" id="wizard-navbar">
                <ul class="nav navbar-nav pull-right">
                    <li class="active">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                           aria-expanded="false">
                            {{ studly_case(request()->query('filter')) ?: 'All' }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('logs.index')}}">All</a></li>
                            <li><a href="{{ route('logs.index', ['level_name'=>'ERROR'])}}">Errors</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <!-- Single button -->


    @include('partials._errors')

    <form method="POST" action="{{ route('plans.index') }}">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Level</th>
                <th>Error</th>
                <th>File</th>
                <th>Message</th>
                <th>Date</th>
            </tr>
            </thead>
{{--
            @foreach ($plans as $plan)
                <tr>
                    <td>{{ $plan->name }} </td>
                    <td>{{ $plan->price }} </td>
                    <td>{{ $plan->stripe_plan }}</td>
                    <td>{{ $plan->containers }}</td>
                    <td>
                        @include(
                            'partials._active_toggle',
                            [
                                'active'   => ($plan->deleted_at === null),
                                'endpoint' => route('plans.update', ['plans' => $plan->id])
                            ]
                        )
                    </td>

                </tr>
            @endforeach--}}
            <tbody>

            @foreach($logs as $key => $log)
                <tr>
                    <td class="text-{{ $log['level_name'] }}">
                                <span class="glyphicon glyphicon-alert"
                                      aria-hidden="true"></span> &nbsp;{{$log['level_name']}}
                    </td>
                    <td class="text">{{ $log['error_class'] }}</td>
                    <td class="text">{{ $log['file'] }}</td>
                    <td class="text">
                        {{ $log['message'] }}
                    </td>
                    <td class="date">{{ $log['date'] }}</td>
                </tr>
            @endforeach

            </tbody>
            <tbody>
        </table>

        {{--<a href="{{ route('plans.create') }}"
           type="button"
           class="btn btn-warning btn-sm round raised pull-right"
           style="margin-top: 15px;">+ Plan</a>--}}

    </form>

@endsection


