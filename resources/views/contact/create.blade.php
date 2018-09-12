@extends('layouts.app')

@section('content')
<div class="container">
 <div class="card" style="background: #ffd8b7;">
  <div class="card-header text-center">
   <h4>Contact</h4>
   <form action="{{ config('app.url') }}/contact" method="post">
    @include('contact.form', ['btntxt' => 'Submit'])
    @csrf
   </form>
  </div>
 </div>
</div>
@endsection('content')
