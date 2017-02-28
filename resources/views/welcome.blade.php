@extends('layouts.app')
@section('content')
    <div id="app" class="container">
        <nav class="panel">
            <p class="panel-heading">Buggers</p>
            <bugger v-for="bugger in buggers"
                      :key=bugger.bugger_id
                      :date=bugger.date
                      :error=bugger.error_class
                      :icon=bugger.level_icon
                      :message=bugger.message>
            </bugger>
        </nav>`
        {{--<nav class="panel">
            <p class="panel-heading">Buggers</p>
            <tabs>
                <tab name="all" :selected="true">
                    <bugger-item v-for="bugger in buggers"
                          :key=bugger.bugger_id
                          :date=bugger.date
                          :error=bugger.error_class
                          :icon="bugger.level_icon"
                          :message=bugger.message>
                    </bugger-item>
                </tab>
                <tab name="errors">
                    <bugger-item v-for="bugger in errors"
                              :key=bugger.bugger_id
                              :date=bugger.date
                              :error=bugger.error_class
                              :icon="bugger.level_icon"
                              :message=bugger.message>
                    </bugger-item>
                </tab>
                <tab name="warnings">
                    <bugger-item v-for="bugger in errors"
                              :key=bugger.bugger_id
                              :date=bugger.date
                              :error=bugger.error_class
                              :icon="bugger.level_icon"
                              :message=bugger.message>
                    </bugger-item>
                </tab>
            </tabs>
        </nav>--}}
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.2.0/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="/js/app.js"></script>
@endsection
