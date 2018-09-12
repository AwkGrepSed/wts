@extends('layouts.app')

@section('content')
<div class="container">
 <div class="card">
  <div class="card-header text-center">
   @guest
   @else
    <a class="btn btn-warning btn-sm" href="{{ config('app.url') }}/article/create">New Article</a>
   @endguest
   <form method="GET" action="{{ config('app.url') }}/article">
    @include('article.form', ['btntxt' => 'Search'])
    @csrf
   </form>
  </div>
 </div>
 @if(count($articles) > 0)
 @foreach($articles as $article)
 <p> </p>
 <div class="row">
  <div class="card" style="width: 100%;">
   <div class="card-header">
    <div class="d-inline-flex align-items-center">
    @guest
    @else
     <a class="btn btn-sm btn-info" href="article/{{$article->id}}/edit">Edit</a>
     <form action="{{ config('app.url') }}/article/{{$article->id}}" method="post">
      <input type="submit" class="btn btn-sm btn-danger" title="Beware: No confirmation asked/required" value="Delete">
      @method('delete')
      @csrf
     </form>
    @endguest
    <a class="ml-3" href="{{ config('app.url') }}/article/{{$article->id}}">{{$article->title}}</a>
    </div>
   </div>
   <div class="card-body">
    <p class="card-text">{{ substr($article->body,0,255) }}</p>
    <p class="card-text">
     <small class="text-muted">
      <b>by:</b> {{$article->user->name}}
      <b>on:</b> {{$article->created_at}}
      <b>updated:</b> {{$article->updated_at}}
     </small>
    </p>
   </div>
  </div>
 </div>
 @endforeach
 <hr>
 <div class="pagination justify-content-center">{{$articles->oneachside(5)->links()}}</div>
 @else
 <hr>
 <div class="alert alert-danger text-center" role="alert">Sorry, no articles found</div>
 @endif
</div>
@endsection('content')
