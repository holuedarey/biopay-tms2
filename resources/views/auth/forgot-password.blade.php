@extends('layouts.auth.master')
@section('title', 'Login')

@section('content')
    <form action="{{ route('password.email') }}" method="post" class="theme-form my-form">
        @csrf
        <h4>Forgot Your Password?</h4>
        <p>No need to worry. Just enter your registered email and we'll send you a password reset link</p>
        <div class="form-group">
            <label class="col-form-label">Email Address</label>
            <input class="form-control" type="email" name="email" required placeholder="Test@gmail.com" value="{{ old('email') }}">
        </div>
        <div class="form-group mb-0">

            <button class="btn btn-primary btn-block w-100 mt-2" type="submit">Submit</button>
        </div>
        <p class="mt-4 mb-0 small text-center">Back to <a href="{{  route('login') }}">Login</a></p>
    </form>
@endsection

@section('script')
@endsection