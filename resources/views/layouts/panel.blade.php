@extends('layouts.app')
@section('content')
<div class="container">
    <nav class="panel">
        <p class="panel-heading">
            @yield('panel-heading')
        </p>

        @if(isset($searchable))
            <div class="panel-block">
                <p class="control has-icon">
                    <input class="input is-small" type="text" placeholder="Search">
                    <span class="icon is-small"><i class="fa fa-search"></i></span>
                </p>
            </div>
        @endif

        <p class="panel-tabs">
            @yield('panel-tabs')
        </p>

        @yield('panel-content')
    </nav>
</div>

@endsection
