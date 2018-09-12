<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Resources\ArticleResource;
use Auth;
use DB;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    if ($request->is('api/*'))
    {
      $articles = Article::orderby('id')->paginate(14);
      return ArticleResource::collection($articles);
    }

    $search = [
      'title' => $request->input('title' , ''),
      'body'  => $request->input('body'  , ''),
    ];

    $orderby  = "updated_at desc, title";
    $articles = Article::wecansee()
      ->where('title' , 'ilike', '%'.$search['title'].'%')
      ->where('body'  , 'ilike', '%'.$search['body'].'%')
      ->orderbyraw($orderby)
      ->paginate(14);

    return view('article.index')
      ->with([
        'articles' => $articles,
        'search'   => $search
        ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('article.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $this->validate($request, [
      'title'    => 'required|min:3|max:255',
      'body'     => 'required',
      ]);

    $article = new Article;
    $article->userid  = auth()->user()->id;
    $article->title   = $request->input('title'  , 'NoTitle');
    $article->body    = $request->input('body'   , 'NoBody');
    $article->save();

    if ($request->is('api/*'))
    {
      return new ArticleResource($article);
    }
    return redirect('/article')->with('success', 'ArticleID '.$article->id.' Saved');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Article  $article
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function show(Article $article, Request $request)
  {
    if ($request->is('api/*'))
    {
      return new ArticleResource($article);
    }
    return view('article.show')->with('article', $article);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Article  $article
   * @return \Illuminate\Http\Response
   */
  public function edit(Article $article)
  {
    return view('article.edit')->with('article', $article);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Article  $article
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function update(Article $article, Request $request)
  {
    $this->validate($request, [
      'title'    => 'required',
      'body'     => 'required',
      ]);

    $article->userid  = auth()->user()->id;
    $article->title   = $request->input('title'  , 'NoTitle');
    $article->body    = $request->input('body'   , 'NoBody');
    $article->save();

    if ($request->is('api/*'))
    {
      return new ArticleResource($article);
    }
    return redirect('/article')->with('success', 'ArticleID '.$article->id.' Updated');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Article  $article
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function destroy(Article $article, Request $request)
  {
    $article->delete();

    if ($request->is('api/*'))
    {
      return new ArticleResource($article);
    }
    return redirect('/article')->with('success', 'ArticleID '.$article->id.' Deleted');
  }
}
