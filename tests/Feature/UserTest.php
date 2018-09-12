<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
  use DatabaseTransactions;

  /**
   * User tests
   *
   * @return void
   */
  public function testUser()
  {
    $user  = factory(User::class)->create(['isadmin' => true]);
    $user  = factory(User::class)->create();
    $user  = factory(User::class)->create();

    $users = User::all();

    $this->assertCount(3, $users);


    // does the resource exist and the api work?
    $user     = User::isadmin()->first();
    $apitoken = $user->api_token;
    $url      = '/api/user?api_token=' . $apitoken;

    $jsondata = $this->get($url)->decodeResponseJson();
    $udataary = $jsondata['data'];
    $this->assertCount(3, $udataary);
  }
}
