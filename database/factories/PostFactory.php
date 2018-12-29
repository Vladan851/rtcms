<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        //
        'url' => $faker->url,
        'user_id' => $faker->numberBetween(1,3),
        'photo_id' =>$faker->numberBetween(1,10), 
        'category_id' =>$faker->numberBetween(1,10), 
        'author' => $faker->name,
        'source' => $faker->name,
        'title' => $faker->sentence(7,11),
        'content' => $faker->paragraphs(rand(10, 15), true),
        'published' => rand(0, 1),
        'featured' => rand(0, 1),
        'count' => $faker->numberBetween(1,10000), 
    ];
});
