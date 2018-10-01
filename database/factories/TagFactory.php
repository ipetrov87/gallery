<?php

use Faker\Generator as Faker;

$factory->define(App\Tag::class, function (Faker $faker) {
    $tag = $faker->words($faker->numberBetween(1, 3), true);
    return [
        'name' => $tag,
        'slug' => str_slug($tag, "-"),
    ];
});
