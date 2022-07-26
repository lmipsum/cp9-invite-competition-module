<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\PageSubmitValue::class, function (Faker $faker) {
    return [
        'page_submit_id' => function () {
            return factory(App\PageSubmit::class)->create()->id;
        },
        'key' => $faker->word,
        'value' => $faker->sentence,
    ];
});
