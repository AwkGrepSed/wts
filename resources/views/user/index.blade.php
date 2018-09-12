@extends('layouts.app')

@section('content')
<div class="container">
 <div class="card">
  @if (auth()->user()->isadmin)
  <div class="card-header text-center">
   <a class="btn btn-warning btn-sm" href="{{ config('app.url') }}/user/create">New User</a>
   <form method="GET" action="{{ config('app.url') }}/user">
    @include('user.form', ['btntxt' => 'Search'])
    @csrf
   </form>
  </div>
  @endif
 </div>
 @if (count($users) > 0)
 @foreach($users as $user)
 <p> </p>
 <div class="row">
  <div class="card" style="width: 100%;">
   <div class="card-header">
    <div class="d-inline-flex align-items-center">
     <a class="btn btn-sm btn-info" href="user/{{$user->id}}/edit">Edit</a>
     <form action="{{ config('app.url') }}/user/{{$user->id}}" method="post">
      <input type="submit" class="btn btn-sm btn-danger" title="Beware: No confirmation asked/required" value="Delete">
      @method('delete')
      @csrf
     </form>
    <a class="ml-3" href="{{ config('app.url') }}/user/{{$user->id}}">{{$user->name}}</a>
    </div>
    <p class="card-text">
     <small class="text-muted">
      <b>email:</b> {{$user->email}}
      <b>isadmin:</b> {{ ($user->isadmin)?"Yes":"No" }}
     </small>
    </p>
   </div>
   <div class="card-body">
    <p class="card-text">
     <small class="text-muted">
      <b>on:</b> {{$user->created_at}}
      <b>updated:</b> {{$user->updated_at}}
     </small>
    </p>
   </div>
  </div>
 </div>
 @endforeach
 <hr>
 <div class="pagination justify-content-center">{{$users->links()}}</div>
 @else
 <hr>
 <div class="alert alert-danger text-center" role="alert">Sorry, no users found</div>
 @endif
</div>
@endsection('content')
