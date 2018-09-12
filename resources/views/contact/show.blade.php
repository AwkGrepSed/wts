@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
 <div class="card" style="width: 100%;">
  <div class="card-title alert-warning">
   <p> </p>
   <h5 class="card-subtitle text-info">{{$contact->company}}</h5>
   <p> </p>
   <div class="d-inline-flex align-items-center">
    <a href="{{ config('app.url') }}/contact/{{$contact->id}}/edit" class="btn btn-sm btn-info">Edit</a>
    <form action="{{ config('app.url') }}/contact/{{$contact->id}}" method="post">
     <input type="submit" class="btn btn-sm btn-danger" title="Beware: No confirmation asked/required" value="Delete">
     @method('delete')
     @csrf
    </form>
    <p class="card-subtitle">
     <small class="text-muted">
      <b>person:</b> {{$contact->person}}
      <b>email:</b> {{$contact->email}}
      <b>phone:</b> {{$contact->phone}}
      <b>on:</b> {{$contact->created_at}}
      <b>updated:</b> {{$contact->updated_at}}
     </small>
    </p>
   </div>
  </div>
  <div class="card-body">
   <div class="row">
    <p class="card-text">{{$contact->message}}</p>
   </div>
  </div>
 </div>
</div>
</div>
@endsection('content')
