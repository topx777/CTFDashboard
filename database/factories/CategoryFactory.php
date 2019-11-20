<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        //
        'id' => $faker->numberBetween(6, 100),
        'name' => $faker->name,
        'description' => $faker->state
    ];
});
