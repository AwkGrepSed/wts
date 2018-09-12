<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PagesTest extends TestCase
{
  /**
   * PagesController tests
   *
   * @return void
   */
  public function testRoot()
  {
    $this->get('/')->assertsee("The Wizard");
  }

  public function testAbout()
  {
    $this->get('/about')->assertStatus(200);
  }

  public function testWhoops()
  {
    $this->get('/whoops')->assertsee("Whoops");
  }
}
