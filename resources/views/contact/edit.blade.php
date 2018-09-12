@extends('layouts.app')

@section('content')
<div class="container">
 <div class="card">
  <div class="card-header text-center">
  <h5>Edit Contact</h5>
  <div class="card-body">
   <form method="POST" action="{{ config('app.url') }}/contact/{{$contact->id}}">
   @include('contact.form', ['btntxt' => 'Save'])
   @method('put')
   @csrf
   </form>
  </div>
 </div>
</div>
@endsection('content')
