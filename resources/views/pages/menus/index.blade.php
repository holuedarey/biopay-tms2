@extends('layouts.simple.master')

@section('title', 'Menus')

@section('breadcrumb-title')
    <h3>Menus</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Menus</li>
@endsection

@section('content')
    <div class="container-fluid" x-data="{menu: {}, action: ''}">
        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex flex-md-row flex-column-reverse gap-2 align-items-md-center">
                        <p class="mb-0 me-auto">Showing list of all Terminal Menus.</p>
                    </div>

                    <div class="card-body">
                        <div class="list-product">
                            <table class="table" id="project-status">
                                <thead>
                                <tr>
                                    <th> <span class="f-light f-w-600">#</span></th>
                                    <th> <span class="f-light f-w-600">Name</span></th>
                                    <th> <span class="f-light f-w-600">Service</span></th>
                                    <th> <span class="f-light f-w-600">Terminals</span></th>
                                    <th data-sortable="false">
                                        <span class="f-light f-w-600">
                                            <i class="fa fa-cogs"></i>
                                        </span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($menus as $menu)
                                    <tr class="product-removes">
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            <p class="f-light">{{ $menu->menu_name }}</p>
                                        </td>
                                        <td>
                                            <p class="f-light">{{ $menu->name }}</p>
                                        </td>
                                        <td>
                                            <span class="badge rounded-circle badge-p-space badge-light-info">{{ $menu->terminals_count }}</span>
                                        </td>

                                        <td>
                                            <div class="product-action">
                                                <button class="btn btn-info btn-sm d-flex align-items-center gap-1 px-2 py-1"
                                                        data-bs-toggle="modal" data-bs-target="#edit-menu"
                                                        x-on:click="action = '{{ route('services.update', $menu) }}'; menu = @js($menu->only('menu_name'));"
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

        <x-menus.edit />

    </div>
@endsection
