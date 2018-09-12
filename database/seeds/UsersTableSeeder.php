<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // would you prefer using the factory?
    // factory(App\UserFactory::class, 30)->create();

    // seeds all have same password, yep, you guessed it "password"
    // everyone else uses it, so why not me?
    $password = Hash::make('password');

    // api_token, is a hexadecimal value of a randomly generated
    // number of characters.  see the app/User.php model

    // should be id 1, assuming a complete refresh
    $user = new User;
    $user->name      = 'Administrator';
    $user->email     = 'admin@wts.com';
    $user->password  = $password;
    $user->isadmin   = true;
    $user->api_token = $user->gennewapitoken();
    $user->save();

    // others, just for shigiggles
    for ($i = 10; $i <= 40; $i++)
    {
      $user = new User;
      $user->name      = 'User '.$i;
      $user->email     = 'user'.$i.'@wts.com';
      $user->password  = $password;
      if ($i %6 == 0) { $user->isadmin = true; }
      $user->api_token = $user->gennewapitoken();
      $user->save();
    }
  }
}
