@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
 <div class="card" style="width: 100%;">
  <div class="card-title alert-warning">
   <p> </p>
   <h5 class="card-subtitle text-info">{{$user->name}}</h5>
   <p> </p>
   <div class="d-inline-flex align-items-center">
    <a href="{{ config('app.url') }}/user/{{$user->id}}/edit" class="btn btn-sm btn-info">Edit</a>
    <form action="{{ config('app.url') }}/user/{{$user->id}}" method="post">
     <input type="submit" class="btn btn-sm btn-danger" title="Beware: No confirmation asked/required" value="Delete">
     @method('delete')
     @csrf
    </form>
    <p class="card-subtitle">
     <small class="text-muted">
      <b>id:</b> {{$user->id}}
      <b>email:</b> {{$user->email}}
      <b>isadmin:</b> {{ ($user->isadmin)?"Yes":"No" }}
      <b>on:</b> {{$user->created_at}}
      <b>updated:</b> {{$user->updated_at}}
     </small>
    </p>
   </div>
  </div>
  <div class="card-body">
   <div class="row">
    <p class="card-text">{{$user->name}}</p>
   </div>
  </div>
 </div>
</div>
</div>
@endsection('content')
