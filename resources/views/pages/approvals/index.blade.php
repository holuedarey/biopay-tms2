@extends('layouts.simple.master')

@section('title', 'Approvals')

@section('breadcrumb-title')
    <h3>Approvals</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Pending Approvals</li>
@endsection

@section('content')
    <div class="container-fluid"  x-data="{approval: {}, approvalRoute: null, action: ''}">
        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        Showing list of all pending approvals.
                    </div>

                    <div class="card-body">
                        <div class="list-product">
                            <table class="table" id="project-status">
                                <thead>
                                <tr>
                                    <th> <span class="f-light f-w-600">#</span></th>
                                    <th> <span class="f-light f-w-600">Resource</span></th>
                                    <th> <span class="f-light f-w-600">Action</span></th>
                                    <th> <span class="f-light f-w-600">Performed By</span></th>
                                    <th> <span class="f-light f-w-600 pe-2">Date</span></th>
                                    <th data-sortable="false">
                                        <span class="f-light f-w-600">
                                            <i class="fa fa-cogs"></i>
                                        </span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($approvals as $approval)
                                    <tr class="product-removes">
                                        <td>{{ $loop->iteration }}</td>

                                        <td class="w-56">{{ $approval->resource }}</td>

                                        <td class=""><x-badge :value="$approval->action" :color="statusColor($approval->action)" /></td>
                                        <td>
                                            <p class="f-light">{{ $approval->author->name ?? '' }}</p>
                                        </td>
                                        <td>
                                            <p class="f-light">{{ $approval->created_at->toDayDateTimeString() }}</p>
                                        </td>

                                        <td>
                                            <div class="product-action">
                                                <button class="btn btn-primary btn-sm d-flex align-items-center gap-1 px-2 py-1"
                                                        data-bs-toggle="modal" data-bs-target="#view-approval"
                                                        x-on:click="approvalRoute = '{{ route('approvals.update', $approval) }}'; action = '{{ $approval->action }}'; approval = @js($approval)"
                                                >
                                                    <i class="fa fa-eye"></i> View
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

        <x-approvals.details />
    </div>
@endsection
