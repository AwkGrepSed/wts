<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ABasicTest extends TestCase
{
  use DatabaseTransactions;

  /**
   * A basic test example.
   *
   * @return void
   */
  public function testBasicTest()
  {
    // check phpunit.xml  for <env name="APP_URL" value="http://localhost:8000"/>
    $this->get('/')->assertstatus(200);
  }
}
