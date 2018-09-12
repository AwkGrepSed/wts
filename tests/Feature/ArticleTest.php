<?php

namespace Tests\Feature;

use App\Article;
use App\Http\Resources\ArticleResource;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleTest extends TestCase
{
  use DatabaseTransactions;

  /**
   * Articles testing
   *
   * @return void
   */
  public function testArticle()
  {
    // Given:  articles in database months apart
    $a1  = factory(Article::class)->create([
      'created_at' => \Carbon\Carbon::now()->submonth(6)
    ]);

    $a2  = factory(Article::class)->create([
      'created_at' => \Carbon\Carbon::now()->submonth(4)
    ]);

    $a3  = factory(Article::class)->create([
      'created_at' => \Carbon\Carbon::now()->submonth(2)
    ]);

    $a4  = factory(Article::class)->create([
      'created_at' => \Carbon\Carbon::now()
    ]);


    // I should have the number of articles I created
    $articles = Article::all();
    $this->assertCount(4, $articles);


    // and the archives should be in proper order
    $archives = Article::archives();

    $expected = [
      [
        'year'    => $a4->created_at->format('Y'),
        'month'   => $a4->created_at->format('m'),
        'records' => 1
      ],
      [
        'year'    => $a3->created_at->format('Y'),
        'month'   => $a3->created_at->format('m'),
        'records' => 1
      ],
      [
        'year'    => $a2->created_at->format('Y'),
        'month'   => $a2->created_at->format('m'),
        'records' => 1
      ],
      [
        'year'    => $a1->created_at->format('Y'),
        'month'   => $a1->created_at->format('m'),
        'records' => 1
      ]
    ];

    //dd($expected, $archives,
    //   $a1->created_at->format('Y-m-d'),
    //   $a2->created_at->format('Y-m-d'),
    //   $a3->created_at->format('Y-m-d'),
    //   $a4->created_at->format('Y-m-d')
    //);

    $this->assertequals($expected, $archives);


    // does the resource exist and the api work?
    $article  = Article::all()->first();
    $apitoken = $article->user->api_token;
    $url      = '/api/article?api_token=' . $apitoken;

    $jsondata = $this->get($url)->decodeResponseJson();
    $adataary = $jsondata['data'];
    $this->assertCount(4, $adataary);
  }
}
