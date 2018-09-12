<?php

use Faker\Generator as Faker;

$factory->define(App\Contact::class, function (Faker $faker) {
  return [
    'company'   => $faker->company,
    'person'    => $faker->name,
    'email'     => $faker->safeemail,
    'phone'     => $faker->phonenumber,
    'message'   => $faker->sentence(6)
  ];
});
