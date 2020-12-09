<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    for ($i = 1; $i < 21; $i++)
    {
      $random_date = [rand(2017, 2019), rand(1, 12), rand(1,31)];

      if(!checkdate($random_date[1], $random_date[2], $random_date[0])){
        $random_date = [rand(2017, 2019), rand(1, 12), 1];
      }
    }

    return [
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'role' => 10,
        'created_at'         => new DateTime($random_date[0].'-'.$random_date[1].'-'.$random_date[2]),
        'updated_at'         => new DateTime($random_date[0].'-'.$random_date[1].'-'.$random_date[2]),
        'token'              => str_random(15),
        'email_verified_at' => now(),
        'status'             => 1,
    ];
});
