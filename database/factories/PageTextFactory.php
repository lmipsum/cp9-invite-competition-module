<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\PageText::class, function (Faker $faker) {
    return [
        'page_id' => function () {
            return factory(App\Page::class)->create()->id;
        },
        'name' => $faker->colorName,
        'key' => function (array $attributes) use ($faker) {
            $key = null;

            while (!$key || \App\PageText::where('page_id', $attributes['page_id'])->where('key', $key)->count()) {
                $key = $faker->word;
            }

            return $key;
        },
        'value' => $faker->sentence,
    ];
});
