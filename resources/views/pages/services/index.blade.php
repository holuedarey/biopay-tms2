@extends('layouts.simple.master')

@section('title', 'Services & Providers')

@section('breadcrumb-title')
    <h3>Services</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Services</li>
@endsection

@section('content')
    <div class="container-fluid"  x-data="{action: '', service: {}}">
        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex flex-md-row flex-column-reverse gap-2 align-items-md-center">
                        <p class="mb-0 me-auto">Showing list of all Services and respective selected provider.</p>
                        <a href="{{ route('providers.index') }}"
                           class="btn btn-primary btn-hover-effect d-flex justify-content-center align-items-center gap-2 px-3"
                        >
                            <span>Manage Providers</span>
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="table-light">
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Provider</th>
                                    <th>
                                        <span class="f-light f-w-600">
                                            <i class="fa fa-cogs"></i>
                                        </span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($services as $service)
                                    <tr>
                                        <td class="w-56">{{ ucwords($service->name) }}</td>

                                        <td class="whitespace-nowrap">{{ $service->description }}</td>

                                        <td>
                                            @if($service->internal)
                                                <div class="w-50 p-2 border rounded">INTERNAL</div>
                                            @else
                                                <livewire:provider-select :service="$service" />
                                            @endif
                                        </td>
                                        <td class="">
                                            <div class="d-flex align-items-center gap-2">
                                                <livewire:service-status :service="$service" />

                                                <button class="btn btn-info btn-sm d-flex align-items-center gap-1 px-2 py-1"
                                                        data-bs-toggle="modal" data-bs-target="#edit-service"
                                                        x-on:click="action = '{{ route('services.update', $service) }}'; service = @js($service)"
                                                >
                                                    <i class="fa fa-edit"></i> Edit
                                                </button>
                                            </div>
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

        <x-services.edit />
    </div>
@endsection
