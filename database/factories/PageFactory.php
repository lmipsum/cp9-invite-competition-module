<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Page::class, function (Faker $faker) {
    return [
        'company_id' => function () {
            return factory(App\Company::class)->create()->id;
        },
        'hash' => function () {
            $hash = null;

            while (!$hash || App\Page::where('hash', $hash)->count()) {
                $hash = str_random(8);
            }

            return $hash;
        },
        'name' => $faker->word,
        'template' => $faker->randomElement(['invite', 'competition', 'competition-winhuus']),
    ];
});
