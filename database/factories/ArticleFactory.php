<?php

use Faker\Generator as Faker;

$factory->define(App\Article::class, function (Faker $faker) {
  return [
    'userid' => function () {
      return factory(App\User::class)->create()->id;
    },
    'title'  => $faker->sentence,
    'body'   => $faker->paragraph
  ];
});
