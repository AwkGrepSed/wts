<?php

use App\Article;
use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // would you prefer using the factory?
    // factory(App\ArticleFactory::class, 30)->create();

    // some articles, using predictable values
    for ($i = 10; $i <= 60; $i++)
    {
      $article = new Article;
      $article->userid   = 2;
      if ($i %10 == 0) { $article->userid = 1; }
      if ($i %4 == 0)  { $article->userid = 3; }
      if ($i %6 == 0)  { $article->userid = 4; }
      $article->title    = 'Article '.$i;
      $article->body     = 'Body of Article '.$i;
      if ($i %5 == 0)  { $article->body .= ' Haha!'; }
      $article->save();
    }
  }
}
