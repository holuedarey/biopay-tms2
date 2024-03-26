@extends('layouts.simple.master')

@section('title', 'Permissions')

@section('breadcrumb-title')
    <h3>Permissions</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Permissions</li>
@endsection

@section('content')
    <div class="container-fluid" >
        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex flex-md-row flex-column-reverse gap-2 align-items-md-center">
                        <p class="mb-0 me-auto">Showing list of all permissions.</p>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="table-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Roles</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($permissions as $permission)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td class="w-56">{{ ucwords($permission->name) }}</td>

                                        <td>{{ $permission->description ?? '...' }}</td>

                                        <td><span class="text-info font-semibold">{{ $permission->roles->pluck('name')->implode(', ') }}</span></td>
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
