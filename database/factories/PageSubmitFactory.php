<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\PageSubmit::class, function (Faker $faker) {
    return [
        'page_id' => function () {
            return factory(App\Page::class)->create()->id;
        },
    ];
});
