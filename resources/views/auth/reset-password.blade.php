@extends('layouts.auth.master')
@section('title', 'Login')

@section('content')
    <form action="{{ route('password.update') }}" method="post" class="theme-form my-form">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <h4>Password Reset</h4>
        <p>Enter your new password.</p>
        <div class="alert alert-light-info show my-2" role="alert">
            <div class="flex items-center">
                <div class="fw-medium fs-6 text-info">This is your first login attempt...</div>
            </div>
            <p class="mt-1 mb-0"><strong>Note: &nbsp;</strong>{{ __('auth.first-login') }}</p>
        </div>
        @if(session('alert') == 'auth.first-login')

        @endif
        <div class="form-group">
            <label class="col-form-label">Email Address</label>
            <input class="form-control" type="email" name="email" value="{{ request('email') }}" @readonly(request('email')) required>
        </div>
        <div class="form-group">
            <label for="password" class="col-form-label">Password</label>
            <input id="password" class="form-control" type="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="password_confirm" class="col-form-label">Confirm Password</label>
            <input id="password_confirm" class="form-control" type="password" name="password_confirmation" required>
        </div>
        <div class="form-group mb-0">
            <button class="btn btn-primary btn-block w-100 mt-2" type="submit">Submit</button>
        </div>
        <p class="mt-4 mb-0 small text-center">Back to <a href="{{  route('login') }}">Login</a></p>
    </form>
@endsection

@section('script')
@endsection