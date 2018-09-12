@extends('layouts.app')

@section('content')
<div class="container">
 <div class="card">
  <div class="card-header text-center">
  <h4>User</h4>
  <div class="card-body">
  <form action="{{ config('app.url') }}/user" method="post">
   @include('user.form', ['btntxt' => 'Create'])
   @csrf
  </form>
  </div>
 </div>
</div>
@endsection('content')
