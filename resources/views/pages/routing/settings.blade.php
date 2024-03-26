@extends('layouts.simple.master')

@section('title', $type . ' Settings')

@section('breadcrumb-title')
    <h3>{{ $type }} Settings</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('routing.index') }}">Routing</a></li>
    <li class="breadcrumb-item active">{{ $type }} Settings</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex flex-md-row flex-column-reverse gap-2 align-items-md-center">
                        <p class="mb-0 me-auto">Showing list of all {{ $type }} settings.</p>
                    </div>

                    <div class="card-body">
                        <div class="list-product">
                            <table class="table" id="project-status">
                                <thead>
                                <tr>
                                    <th> <span class="f-light f-w-600">#</span></th>
                                    <th> <span class="f-light f-w-600">Min Amount</span></th>
                                    <th> <span class="f-light f-w-600">Max Amount</span></th>
                                    <th> <span class="f-light f-w-600">Primary</span></th>
                                    <th> <span class="f-light f-w-600">Secondary</span></th>
                                    <th> <span class="f-light f-w-600">Date Created</span></th>
                                    <th data-sortable="false">
                                        <span class="f-light f-w-600">
                                            <i class="fa fa-cogs"></i>
                                        </span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($items as $item)
                                    <tr class="product-removes">
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            <p class="f-light">@money($item->min_amount)</p>
                                        </td>
                                        <td>
                                            <p class="f-light">@money($item->max_amount)</p>
                                        </td>
                                        <td>
                                            <p class="f-light">{{ ucwords($item->primary) }}</p>
                                        </td>
                                        <td>
                                            <p class="f-light">{{ ucwords($item->secondary) }}</p>
                                        </td>
                                        <td>
                                            <p class="f-light">{{ $item->created_at->toDayDateTimeString() }}</p>
                                        </td>

                                        <td>
                                            <div class="product-action">
                                                <a href="#" class="btn btn-info btn-sm d-flex align-items-center gap-1 px-2 py-1">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                                <a href="#" class="btn btn-danger btn-sm d-flex align-items-center gap-1 px-2 py-1">
                                                    <i class="fa fa-trash-o"></i> Delete
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
