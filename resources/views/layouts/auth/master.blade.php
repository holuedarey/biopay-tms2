<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Teqpace">
    <link rel="icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon">
     <title>{{ config('app.name') }} :: @yield('title')</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
    
    @include('layouts.auth.css')
    @yield('style') 
  </head>
  <body>
  <x-session-msg />

    <!-- login page start-->
    <div class="container-fluid p-0">
      <div class="row m-0">
        <div class="col-12 p-0">
          <div class="login-card">
            <div>
              <div>
                <a class="logo" href="{{ route('dashboard') }}">
                  <img class="img-fluid for-light" src="{{asset('assets/images/logo/login.png')}}" width="150" alt="looginpage">
                </a>
              </div>
              <div class="login-main">
                @yield('content')
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- latest jquery-->
    @include('layouts.auth.script')
  </body>
</html>