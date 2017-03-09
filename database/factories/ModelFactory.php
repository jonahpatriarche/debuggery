<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/
use App\Bugger;

$factory->define(App\Bugger::class, function (Faker\Generator $faker) {
    $data = [
        'message'    => 'Example Error Log',
        'level'      => 400,
        'level_name' => 'ERROR'
    ];

    $data['formatted'] = json_encode($data);

    return $data;
});
$factory->define(App\Tracker::class, function (Faker\Generator $faker) use ($factory) {
    return [
        'name'        => 'Test Tracker',
        'description' => 'Example error tracker for testing purposes',
        'bugger_id'   => $factory->create(Bugger::class)->id,
        'is_active'   => 1,
        'is_resolved' => 0
    ];

});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
