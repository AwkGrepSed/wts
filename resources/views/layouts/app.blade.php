<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">

 <!-- CSRF Token -->
 <meta name="csrf-token" content="{{ csrf_token() }}">

 <title>Wizard Technical Services - {{ config('app.name') }}</title>

 <!-- Scripts -->
 <script src="{{ asset('js/app.js') }}" defer></script>

 <!-- Fonts
 <link rel="dns-prefetch" href="https://fonts.gstatic.com">
 <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
 -->

 <!-- Styles -->
 <link href="{{ asset('css/app.css') }}" rel="stylesheet">

 <!-- Styles overrides -->
 <style>
  body,html { font-family: verdana; line-height:1.2; }
  .headshot { border-radius: 8px; float: left; margin:8px; padding:2px; }
  #mainleft { background: #ffd8b7; }
  #maincntr { background: #e2e2e2; }
  #mainrght { background: #ff9; }
 </style>

</head>
<body>
 <div id="app">
  <nav class="navbar navbar-expand-md navbar-dark bg-dark my-0 py-0">
   <div class="container-fluid">
    <a class="navbar-brand" href="{{ url('/') }}"> {{ config('app.name') }} </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
     <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
     <!-- Left Side Of Navbar -->
     <ul class="navbar-nav mr-auto">
      <!-- Links available to you -->
      @guest
       <li><a class="nav-link btn btn-sm" href="{{ config('app.url') }}/article">Articles</a></li>
      @else
       <li><a class="nav-link btn btn-sm" href="{{ config('app.url') }}/article">Articles</a></li>
       <li><a class="nav-link btn btn-sm" href="{{ config('app.url') }}/contact">Contacts</a></li>
       <li><a class="nav-link btn btn-sm" href="{{ config('app.url') }}/user">Users</a></li>
      @endguest
     </ul>

     <!-- Right Side Of Navbar -->
     <ul class="navbar-nav ml-auto">
      <!-- Links available to you -->
      @guest
       <li><a class="nav-link btn btn-sm" href="{{ config('app.url') }}/about">About</a></li>
       <li><a class="nav-link btn btn-sm" href="{{ config('app.url') }}/contact/create">Contact</a></li>
       <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
       <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
      @else
       <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
         {{ Auth::user()->email }} <span class="caret"></span>
        </a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
         <a class="dropdown-item" href="{{ route('password.changeit') }}">Change Password</a>
         <div class="dropdown-divider"></div>
         <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> @csrf </form>
        </div>
       </li>
      @endguest
     </ul>
    </div>
   </div>
  </nav>
  <main class="container-fluid">
   @include('messages')
   @yield('content')
  </main>
 </div>
</body>
</html>
