<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('buggers', 'BuggersController@index')->name('buggers.index');
Route::get('buggers/{id}', 'BuggersController@show')->name('buggers.show');

// Bugger model is bound in RouteServiceProvider, so Laravel will automatically inject the Bugger with the given id
Route::get('trackers/{bugger}/create')->name('trackers.create');

/*Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');*/

