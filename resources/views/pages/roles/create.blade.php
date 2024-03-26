@extends('layouts.simple.master')

@section('title', 'Add New Role')

@section('breadcrumb-title')
    <h3>Add New Role</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
    <li class="breadcrumb-item active">Add New Role</li>
@endsection

@section('content')
    <div class="container-fluid" >
        <div class="row gap-3 mt-5">
            <div class="col-12 col-md-10 col-lg-12 col-xl-9">
                <!-- BEGIN: Form Layout -->
                <div class="card">
                    <form class="card-body p-5" method="post" action="{{ route('roles.store') }}">
                        @csrf

                        <div class="mt-3">
                            <label for="gender" class="form-label text-secondary">Role Name</label>
                            <input type="text" class="form-control" placeholder="Enter new role name" aria-label="new role name"
                                   name="name" value="{{ old('name') }}" required
                            />
                            <x-input-error :input-name="$error = 'name'" />
                        </div>

                        <input type="hidden" name="type" value="admins">

                        <div class="mt-3">
                            <label class="form-label text-secondary font-semibold">Select Permissions</label>
                            <div class="row">
                                @foreach($permissions as $permission)
                                    <div class="col-6 col-sm-4 col-lg-3 form-check mt-2">
                                        <input id="{{str($permission->name)->slug()}}" class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->name }}">
                                        <label class="form-check-label" for="{{str($permission->name)->slug()}}">{{ ucwords($permission->name) }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="text-end pt-6 border-t mt-3">
                            <button type="reset" class="btn btn-outline-light me-1">Reset</button>
                            <button type="submit" class="btn btn-primary btn-hover-effect">Submit</button>
                        </div>
                    </form>
                    <!-- END: Form Layout -->
                </div>
            </div>
        </div>
    </div>
@endsection
