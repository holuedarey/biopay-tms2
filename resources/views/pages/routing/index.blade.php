@extends('layouts.simple.master')

@section('title', 'Routing')

@section('breadcrumb-title')
    <h3>Routing</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Routing</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex flex-md-row flex-column-reverse gap-2 align-items-md-center">
                        <p class="mb-0 me-auto">Showing list of all routing types.</p>
                    </div>

                    <div class="card-body">
                        <div class="list-product">
                            <table class="table" id="project-status">
                                <thead>
                                <tr>
                                    <th> <span class="f-light f-w-600">#</span></th>
                                    <th> <span class="f-light f-w-600">Name</span></th>
                                    <th> <span class="f-light f-w-600">Active</span></th>
                                    <th> <span class="f-light f-w-600">Date Created</span></th>
                                    <th data-sortable="false">
                                        <span class="f-light f-w-600">
                                            <i class="fa fa-cogs"></i>
                                        </span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($types as $type)
                                    <tr class="product-removes">
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            <p class="f-light">{{ $type->name }}</p>
                                        </td>
                                        <td>
                                            <x-badge :color="$type->active ? 'success' : 'danger'">
                                                {{ $type->active ? 'YES' : 'NO' }}
                                            </x-badge>
                                        </td>
                                        <td>
                                            <p class="f-light">{{ $type->created_at->toDayDateTimeString() }}</p>
                                        </td>

                                        <td>
                                            <div class="product-action">
                                                <a href="{{ route('routing.show', $type) }}" class="btn btn-info btn-sm d-flex align-items-center gap-1 px-2 py-1">
                                                    <i class="fa fa-cog"></i> Settings
                                                </a>
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
    </div>
@endsection
