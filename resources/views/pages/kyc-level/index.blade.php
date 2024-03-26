@extends('layouts.simple.master')

@section('title', 'Terminals')

@section('breadcrumb-title')
    <h3>KYC Levels</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">KYC Levels</li>
@endsection

@section('content')
    <div class="container-fluid" x-data="{level: {}, action: null}">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <p class="mb-0">
                            Showing list of all KYC Levels
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive signal-table">
                            <table class="table table-hover sm:mt-2">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>

                                    <th scope="col">Name</th>

                                    <th scope="col">Daily Limit</th>

                                    <th scope="col">Single Transaction Max</th>

                                    <th scope="col">Maximum Balance</th>

                                    <th scope="col">Required Documents</th>

                                    <th>
                                            <span class="f-light f-w-600">
                                                <i class="fa fa-cogs"></i>
                                            </span>
                                    </th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach ($levels as $level)
                                    <tr>
                                        <td class="">{{ $level->id }}</td>
                                        <td class="">{{ $level->name }}</td>
                                        <td class=""><span class="text-info">@money($level->daily_limit)</span></td>
                                        <td class=""><span class="text-warning">@money($level->single_trans_max)</span></td>
                                        <td class=""><span class="text-dark">@money($level->max_balance)</span></td>
                                        <td class="">{{ $level->document_name }}</td>
                                        <td>
                                            <button class="btn btn-info btn-sm d-flex align-items-center gap-1 px-2 py-1 w-fit"
                                                    data-bs-toggle="modal" data-bs-target="#edit-level"
                                                    x-on:click="action = '{{ route('kyc-levels.update', $level)}}'; level = @js($level);"
                                            >
                                                <i class="fa fa-edit"></i> Edit
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <x-levels.edit />
    </div>
@endsection
