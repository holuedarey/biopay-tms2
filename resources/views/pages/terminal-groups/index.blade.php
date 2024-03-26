@extends('layouts.simple.master')

@section('title', 'Terminal Groups')

@section('breadcrumb-title')
    <h3>Terminal Profiles</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Terminal Profiles</li>
@endsection

@section('content')
    <div class="container-fluid" x-data="{group: {}, action: ''}">
        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex flex-md-row flex-column-reverse gap-2 align-items-md-center">
                        <p class="mb-0 me-auto">Showing list of all terminal profiles.</p>
                        @can('create', \App\Models\TerminalGroup::class)
                            <button type="button"
                                    class="btn btn-primary btn-hover-effect d-flex justify-content-center align-items-center gap-2 px-3"
                                    data-bs-toggle="modal" data-bs-target="#add-terminal"
                            >
                                <i data-feather="plus-square" style="height: 15px"></i>
                                <span>Add New Terminal Profile</span>
                            </button>
                        @endcan
                    </div>

                    <div class="card-body">
                        <div class="list-product">
                            <table class="table" id="project-status">
                                <thead>
                                <tr>
                                    <th> <span class="f-light f-w-600">#</span></th>
                                    <th> <span class="f-light f-w-600">Name</span></th>
                                    <th> <span class="f-light f-w-600">Info</span></th>
                                    <th> <span class="f-light f-w-600">Terminals</span></th>
                                    <th> <span class="f-light f-w-600">Views</span></th>
                                    <th data-sortable="false">
                                        <span class="f-light f-w-600">
                                            <i class="fa fa-cogs"></i>
                                        </span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($terminal_groups as $terminal_group)
                                    <tr class="product-removes">
                                        <td>
                                            <p class="f-light">{{ $loop->iteration }}</p>
                                        </td>
                                        <td>
                                            <p class="f-light">{{ $terminal_group->name }}</p>
                                        </td>
                                        <td>
                                            <p class="f-light">{{ $terminal_group->info }}</p>
                                        </td>
                                        <td>
                                            <p class="f-light">{{ $terminal_group->terminals_count }}</p>
                                        </td>
                                        <td>
                                            <div class="product-action">
                                                <a href="{{ route('terminal-groups.fees.index', $terminal_group) }}"
                                                   class="btn btn-outline-secondary btn-sm d-flex align-items-center gap-1 px-2 py-1"
                                                >
                                                    <i class="fa fa-dollar"></i> Fees
                                                </a>
                                                <a href="{{ route('terminal-groups.terminals.index', $terminal_group) }}"
                                                   class="btn btn-outline-primary btn-sm d-flex align-items-center gap-1 px-2 py-1"
                                                >
                                                    <i class="fa fa-tablet"></i> Terminals
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="product-action">
                                                <button class="btn btn-info btn-sm d-flex align-items-center gap-1 px-2 py-1"
                                                        data-bs-toggle="modal" data-bs-target="#edit-group"
                                                        x-on:click="action = '{{ route('terminal-groups.update', $terminal_group) }}'; group = @js($terminal_group->only(['name', 'info']));"
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

        @can('create', \App\Models\TerminalGroup::class)
            <x-terminal-groups.create />
        @endcan

        <x-terminal-groups.edit />
    </div>
@endsection
