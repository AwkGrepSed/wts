@extends('layouts.app')

@section('content')
<div class="container">
 <div class="card">
  <div class="card-header text-center">
   <a class="btn btn-warning btn-sm" href="{{ config('app.url') }}/contact/create">New Contact</a>
   <form method="GET" action="{{ config('app.url') }}/contact">
    @include('contact.form', ['btntxt' => 'Search'])
    @csrf
   </form>
  </div>
 </div>
 @if(count($contacts) > 0)
 @foreach($contacts as $contact)
 <p> </p>
 <div class="row">
  <div class="card" style="width: 100%;">
   <div class="card-header">
    <div class="d-inline-flex align-items-center">
    @guest
    @else
     <a class="btn btn-sm btn-info" href="contact/{{$contact->id}}/edit">Edit</a>
     <form action="{{ config('app.url') }}/contact/{{$contact->id}}" method="post">
      <input type="submit" class="btn btn-sm btn-danger" title="Beware: No confirmation asked/required" value="Delete">
      @method('delete')
      @csrf
     </form>
    @endguest
    <a class="ml-3" href="{{ config('app.url') }}/contact/{{$contact->id}}">{{$contact->company}}</a>
    </div>
    <p class="card-text">
     <small class="text-muted">
      <b>name:</b> {{$contact->person}}
      <b>email:</b> {{$contact->email}}
      <b>phone:</b> {{$contact->phone}}
     </small>
    </p>
   </div>
   <div class="card-body">
    <p class="card-text">{{$contact->message}}</p>
    <p class="card-text">
     <small class="text-muted">
      <b>on:</b> {{$contact->created_at}}
      <b>updated:</b> {{$contact->updated_at}}
     </small>
    </p>
   </div>
  </div>
 </div>
 @endforeach
 <hr>
 <div class="pagination justify-content-center">{{$contacts->oneachside(5)->links()}}</div>
 @else
 <hr>
 <div class="alert alert-danger text-center" role="alert">Sorry, no contacts found</div>
 @endif
</div>
@endsection('content')
