<?php

use Faker\Generator as Faker;

$factory->define(App\Picture::class, function (Faker $faker) {
    return [
        'user_id' => App\User::inRandomOrder()->first()->id,
        'title' => $faker->words($faker->numberBetween(1, 5), true),
        'description' => $faker->paragraph,
        'picture' => $faker->imageUrl ($faker->numberBetween(150, 1920), $faker->numberBetween(150, 1080)),
    ];
});
