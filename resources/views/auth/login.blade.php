@extends('layouts.auth.master')
@section('title', 'Login')

@section('css')
@endsection

@section('style')
@endsection

@section('content')
    <form action="{{ route('authenticate') }}" method="post" class="theme-form my-form">
        @csrf
        <h4>Sign in to account</h4>
        <p>Enter your email & password to login</p>
        <div class="form-group">
            <label class="col-form-label">Email Address</label>
            <input class="form-control" type="email" name="email" required placeholder="Test@gmail.com" value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <label class="col-form-label">Password</label>
            <input class="form-control" type="password" name="password" required placeholder="*********">
{{--            <div class="show-hide"><span class="show"></span></div>--}}
        </div>
        <div class="form-group mb-0">
            <div class="checkbox p-0">
                <input id="checkbox1" type="checkbox" name="remember">
                <label class="text-muted" for="checkbox1">Remember password</label>
            </div>
            <a class="link" href="{{ route('password.request') }}">Forgot password?</a>
            <button class="btn btn-primary btn-block w-100 mt-2" type="submit">Sign in</button>
        </div>
        {{--                                <p class="mt-4 mb-0">Don't have account?<a class="ms-2" href="{{  route('sig') }}">Create Account</a></p>--}}
    </form>
@endsection

@section('script')
@endsection