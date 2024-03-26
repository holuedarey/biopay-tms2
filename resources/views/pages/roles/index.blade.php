@extends('layouts.simple.master')

@section('title', 'Roles')

@section('breadcrumb-title')
    <h3>Roles</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Roles</li>
@endsection

@section('content')
    <div class="container-fluid" >
        <div class="text-end mb-3">
            <a href="{{ route('roles.create') }}" class="btn btn-primary btn-hover-effect px-3"
            >
                <span>Add New Role</span>
            </a>
        </div>
        <div class="row">
            @foreach($roles as $role)
                <a class="col-12 col-sm-6 col-md-4 col-lg-6 col-xl-4" href="{{ route('roles.show', $role) }}">
                    <div class="card widget-1">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-auto">
                                <h6>{{ $role->name }}</h6>
                                <div class="text-secondary">{{ $role->permissions_count }} permissions</div>
                            </div>
                            <div class="customers text-end">
                                <ul>
                                    @foreach($role->users->take(3) as $user)
                                        <li class="d-inline-block">
                                            <img class="img-30 rounded-circle" src="{{ $user->avatar }}" alt="{{ $user->first_name }} avatar" data-original-title="{{ $user->name }}" title="{{ $user->name }}">
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="text-info">{{ $role->users_count }} users</div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
