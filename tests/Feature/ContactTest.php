<?php

namespace Tests\Feature;

use App\Contact;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactTest extends TestCase
{
  use DatabaseTransactions;

  /**
   * Contact tests
   *
   * @return void
   */
  public function testContact()
  {
    $contact  = factory(Contact::class)->create();
    $contact  = factory(Contact::class)->create();
    $contact  = factory(Contact::class)->create();

    $contacts = Contact::all();

    $this->assertCount(3, $contacts);


    // does the resource exist and the api work?
    $user     = factory(User::class)->create();
    $apitoken = $user->api_token;
    $url      = '/api/contact?api_token=' . $apitoken;

    $jsondata = $this->get($url)->decodeResponseJson();
    $cdataary = $jsondata['data'];
    $this->assertCount(3, $cdataary);
  }
}
