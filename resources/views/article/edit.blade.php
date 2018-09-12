@extends('layouts.app')

@section('content')
<div class="container">
 <div class="card">
  <div class="card-header text-center">
  <h5>Edit Article</h5>
  <div class="card-body">
   <form method="POST" action="{{ config('app.url') }}/article/{{$article->id}}">
   @include('article.form', ['btntxt' => 'Save'])
   @method('put')
   @csrf
   </form>
  </div>
 </div>
</div>
@endsection('content')
