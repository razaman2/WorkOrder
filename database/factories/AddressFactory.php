<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Address::class, function (Faker $faker) {
    return [
    	'type' => $faker->word,
    	'street_1' => $faker->streetAddress,
    	'street_2' => 'suite '.$faker->randomNumber(),
    	'city' => $faker->city,
    	'state' => $faker->randomLetter.$faker->randomLetter,
    	'zip' => $faker->randomNumber(5),
    	'county' => $faker->word,
    	'country' => $faker->country,
    ];
});
