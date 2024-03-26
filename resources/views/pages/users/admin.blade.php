@extends('layouts.simple.master')

@section('title', 'Administration')

@section('breadcrumb-title')
    <h3>Administration</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Administration</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex flex-md-row flex-column-reverse gap-2 align-items-md-center">
                        <p class="mb-0 me-auto">Showing list of all admins.</p>
                        @can('create', \App\Models\User::class)
                            <a href="{{ route('admins.register') }}" class="btn btn-primary btn-hover-effect d-flex justify-content-center align-items-center gap-2 px-3">
                                <i data-feather="user-plus" style="height: 15px"></i>
                                <span>Register Admin</span>
                            </a>
                        @endcan
                    </div>

                    <div class="card-body">
                        <div class="list-product">
                            <table class="table" id="project-status">
                                <thead>
                                <tr>
                                    <th> <span class="f-light f-w-600">Phone</span></th>
                                    <th> <span class="f-light f-w-600">Name</span></th>
                                    <th> <span class="f-light f-w-600">Role</span></th>
                                    <th> <span class="f-light f-w-600 pe-2">Status</span></th>
                                    <th> <span class="f-light f-w-600">Reg. Date</span></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr class="product-removes">
                                        <td>
                                            <x-users.row-data :user="$user" />
                                        </td>
                                        <td>
                                            <p class="f-light">{{ $user->phone }}</p>
                                        </td>
                                        <td>
                                            <x-badge>{{ $user->role_name }}</x-badge>
                                        </td>
                                        <td>
                                            <x-users.status-badge :$user />
                                        </td>
                                        <td>
                                            <p class="f-light" style="width: 180px">{{ $user->created_at->toDayDateTimeString() }}</p>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Individual column searching (text inputs) Ends-->
        </div>
    </div>
@endsection
