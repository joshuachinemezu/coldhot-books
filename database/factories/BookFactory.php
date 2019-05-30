<?php
use Faker\Generator as Faker;

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
$factory->define(App\Book::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'isbn' => $faker->biasedNumberBetween($min = 8, $max = 15),
        'authors' =>  $faker->name,
        'country' => $faker->country,
        'number_of_pages' => $faker->biasedNumberBetween($max = 5),
        'publisher' => $faker->company,
        'release_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
    ];
});
