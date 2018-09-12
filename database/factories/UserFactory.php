<?php

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
  // hash of the word "password" is the value assigned
  return [
    'name'           => $faker->name,
    'email'          => $faker->unique()->safeEmail,
    'password'       => '$2y$10$uUwfjvWeQWDX3OPnQjmtsecD0L4rqe0MwH4Col5NDZGLOWYHCnfLy',
    'remember_token' => str_random(10),
    'api_token'      => bin2hex(openssl_random_pseudo_bytes(40))
  ];
});
