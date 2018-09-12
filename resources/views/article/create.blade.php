@extends('layouts.app')

@section('content')
<div class="container">
 <div class="card">
  <div class="card-header text-center">
  <h4>Article</h4>
  <div class="card-body">
  <form action="{{ config('app.url') }}/article" method="post">
   @include('article.form', ['btntxt' => 'Submit'])
   @csrf
  </form>
  </div>
 </div>
</div>
@endsection('content')
