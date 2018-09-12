<!-- Messaging (if any?) -->
@if(count($errors) > 0)
 <!-- Errors -->
 @foreach($errors->all() as $error)
 <div class="container">
  <div class="alert alert-danger alert-dismissable fade show text-center" role="alert">
   {{$error}}
   <button type="button" class="close" data-dismiss="alert" aria-lable="close">
    <span aria-hidden="true">&times;</span>
   </button>
  </div>
 </div>
 @endforeach
@endif

@if(session('success'))
 <!-- Session -->
 <div class="container">
  <div class="alert alert-success alert-dismissable fade show text-center" role="alert">
   {{session('success')}}
   <button type="button" class="close" data-dismiss="alert" aria-lable="close">
    <span aria-hidden="true">&times;</span>
   </button>
  </div>
 </div>
@endif
@if(session('error'))
 <div class="container">
 <div class="alert alert-danger alert-dismissable fade show text-center" role="alert">
  {{session('error')}}
  <button type="button" class="close" data-dismiss="alert" aria-lable="close">
   <span aria-hidden="true">&times;</span>
  </button>
 </div>
@endif
