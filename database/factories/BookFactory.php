<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'isbn' => $faker->isbn10,
       // 'author_id' => factory('App\Author')->create()->id,
        //'author_id' => $faker->randomDigit,
        'number_of_pages' => $faker->randomDigit,
        'publisher' => $faker->userName,
        'country' => $faker->country,
        'release_date' => $faker->dateTime
    ];
});
