<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    // create users first
    $this->call(UsersTableSeeder::class);

    // some of this may require an existing user (at some point)
    $this->call(ArticlesTableSeeder::class);
    $this->call(ContactsTableSeeder::class);
  }
}
