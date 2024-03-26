@extends('layouts.simple.master')

@section('title', 'Providers')

@section('breadcrumb-title')
    <h3>Providers</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('services.index') }}">Services</a></li>
    <li class="breadcrumb-item active">Providers</li>
@endsection

@section('content')
    <div class="container-fluid"  x-data="{action: '', service: {}}">
        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex flex-md-row flex-column-reverse gap-2 align-items-md-center">
                        <p class="mb-0 me-auto">Showing list of all Providers.</p>
                        <button type="button" class="btn btn-primary btn-hover-effect px-3"
                                data-bs-toggle="modal" data-bs-target="#create-provider"
                        >
                            <span>Add New Provider</span>
                        </button>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="table-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Service</th>
                                    <th scope="col">Created At</th>
                                    <th>
                                        <span class="f-light f-w-600">
                                            <i class="fa fa-cogs"></i>
                                        </span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($providers as $provider)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td class="w-56">{{ ucwords($provider->name) }}</td>

                                        <td><x-badge>@nbsp($provider->service->name)</x-badge></td>

                                        <td>{{ $provider->created_at->toDayDateTimeString() }}</td>
                                        <td class="">
                                            <form action="{{ route('providers.destroy', $provider) }}" class="my-form" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm d-flex align-items-center gap-1 px-2 py-1">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>
                                            </form>
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

        <x-providers.create :$services />
    </div>
@endsection
