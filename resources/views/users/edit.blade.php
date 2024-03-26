@extends('layouts.simple.master')

@section('title', "$user->role_name Profile")

@section('breadcrumb-title')
    <h3>{{ $name = $user->isAdmin() ? 'ADMIN' : $user->role_name }} Profile</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">{{ $name }} Profile</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="edit-profile">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Profile Info</h4>
                            <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                        </div>
                        <div class="card-body">
                            <div class="profile-title">
                                <div class="media align-items-start">
                                    <img class="img-70 rounded-circle" alt="" src="{{ $user->avatar }}">
                                    <div class="media-body">
                                        <h5 class="mb-1">{{ $user->name }}</h5>

                                        <x-badge class="mb-2 bg-primary">{{ $user->role_name }}</x-badge>

                                        <div class="d-flex gap-2 align-items-center">
                                            <x-badge class="h-fit">{{ $user->kycLevel->name }}</x-badge>
                                            <livewire:user-status-badge :user="$user"/>
                                        </div>
                                        @unless($user->isAdmin())
                                            <p class="mb-0 mt-2"><a href="{{ route('users.show', $user) }}">View Stats</a></p>
                                        @endunless
                                    </div>
                                </div>
                            </div>
                            @if($user->is(Auth::user()))
                                <form action="{{ route('users.update', $user) }}" class="border-top pt-3 mt-2">
                                    @csrf
                                    @method('PUT')
                                    <h6 class="mb-1">Change Password</h6>

                                    <div class="mb-3">
                                        <label class="form-label" for="current">Current Password</label>
                                        <input class="form-control" id="current" type="password" name="current">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="password">New Password</label>
                                        <input class="form-control" id="password" type="password" name="password">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="password_confirm">Confirm Password</label>
                                        <input class="form-control" id="password_confirm" type="password" name="password_confirmation">
                                    </div>
                                    <div class="form-footer">
                                        <button class="btn btn-primary btn-block">Save</button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <form action="{{ route('users.update', $user) }}" class="card my-form" method="post">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4 class="card-title mb-0">Edit Profile</h4>
                            <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6 col-md-6">
                                    <div class="mb-3">
                                        <label for="first_name" class="form-label">First Name</label>
                                        <input id="first_name" class="form-control" type="text" name="first_name" value="{{ $user->first_name }}">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="mb-3">
                                        <label for="other_names" class="form-label">Other Names</label>
                                        <input id="other_names" class="form-control" type="text" name="other_names" value="{{ $user->other_names }}">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input id="email" class="form-control" type="email" name="email" value="{{ $user->email }}">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone Number</label>
                                        <input id="phone" class="form-control" type="tel" name="phone" value="{{ $user->phone }}">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <div class="mb-3">
                                        <label for="dob" class="form-label">D.O.B</label>
                                        <input id="dob" class="form-control" type="date" name="dob" value="{{ $user->dob }}" min="{{ now()->subYears(18) }}">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="mb-3">
                                        <label for="gender" class="form-label">Gender</label>
                                        <select class="form-control form-select" name="gender" id="gender">
                                            <option value="" disabled selected></option>
                                            <option value="MALE" @selected(old('gender', $user->gender) == 'MALE')>Male</option>
                                            <option value="FEMALE" @selected(old('gender', $user->gender) == 'FEMALE')>Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="mb-3">
                                        <label for="state" class="form-label">State</label>
                                        <select id="state" class="form-control form-select">
                                            @foreach(config('states') as $state)
                                                <option value="{{ $state }}" @selected(old('state', $user->state) == $state)>{{ $state }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <input id="address" class="form-control" type="text" value="{{ $user->address }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button class="btn btn-primary" type="submit">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
