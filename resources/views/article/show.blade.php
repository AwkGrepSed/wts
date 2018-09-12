@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
 <div class="card" style="width: 100%;">
  <div class="card-title" style="background: #ffd8b7;">
   <p> </p>
   <h5 class="card-subtitle text-info">{{$article->title}}</h5>
   <p> </p>
   <div class="d-inline-flex align-items-center">
    @guest
    @else
    <!-- Edit/Delete only available to user logged in -->
    <a href="{{ config('app.url') }}/article/{{$article->id}}/edit" class="btn btn-sm btn-info">Edit</a>
    <form action="{{ config('app.url') }}/article/{{$article->id}}" method="post">
     <input type="submit" class="btn btn-sm btn-danger" title="Beware: No confirmation asked/required" value="Delete">
     @method('delete')
     @csrf
    </form>
    @endguest
    <p class="card-subtitle">
     <small class="text-muted">
      <b>id:</b> {{$article->id}}
      <b>by:</b> <i>{{$article->user->name}}</i>({{$article->userid}})
      <b>on:</b> {{$article->created_at}}
      <b>updated:</b> {{$article->updated_at}}
     </small>
    </p>
   </div>
  </div>
  <div class="card-body">
   <div class="row">
    <p class="card-text">{{$article->body}}</p>
   </div>
  </div>
 </div>
</div>
</div>
@endsection('content')
