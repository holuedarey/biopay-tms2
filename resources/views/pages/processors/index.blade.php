@extends('layouts.simple.master')

@section('title', 'Processors')

@section('breadcrumb-title')
    <h3>Processors</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Processors</li>
@endsection

@section('content')
    <div class="container-fluid" x-data="{processor: {}, action: ''}">
        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex flex-md-row flex-column-reverse gap-2 align-items-md-center">
                        <p class="mb-0 me-auto">Showing list of all Processors.</p>

                        <button type="button" class="btn btn-primary btn-hover-effect px-3"
                                data-bs-toggle="modal" data-bs-target="#create-processor"
                                x-on:click="action = '{{ route('processors.store') }}'"
                              >Add Processor</button>
                    </div>

                    <div class="card-body">
                        <div class="list-product">
                            <table class="table" id="project-status">
                                <thead>
                                <tr>
                                    <th> <span class="f-light f-w-600">#</span></th>
                                    <th> <span class="f-light f-w-600">Name</span></th>
                                    <th> <span class="f-light f-w-600">Host</span></th>
                                    <th> <span class="f-light f-w-600">Port</span></th>
                                    <th> <span class="f-light f-w-600">Date Created</span></th>
                                    <th data-sortable="false">
                                        <span class="f-light f-w-600">
                                            <i class="fa fa-cogs"></i>
                                        </span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($processors as $processor)
                                    <tr class="product-removes">
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            <p class="f-light">{{ $processor->name }}</p>
                                        </td>
                                        <td>
                                            <p class="f-light">{{ $processor->host }}</p>
                                        </td>
                                        <td>
                                            <p class="f-light">
                                                {{ $processor->port }}<br/>
                                            </p>
                                        </td>
                                        <td>
                                            <p class="f-light">{{ $processor->created_at->toDayDateTimeString() }}</p>
                                        </td>

                                        <td>
                                            <div class="product-action">
                                                <button class="btn btn-info btn-sm d-flex align-items-center gap-1 px-2 py-1"
                                                        data-bs-toggle="modal" data-bs-target="#edit-processor"
                                                        x-on:click="action = '{{ route('processors.update', $processor) }}'; processor = @js($processor);"
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

        <x-processors.edit />
        <x-processors.create />
    </div>
@endsection
