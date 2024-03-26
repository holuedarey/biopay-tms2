@extends('layouts.simple.master')

@section('title', 'Fees')

@section('breadcrumb-title')
    <h3>Fees for Group: {{ $terminalGroup->name }}</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('terminal-groups.index') }}">Terminal Groups</a></li>
    <li class="breadcrumb-item active">{{ $terminalGroup->name }} Fees</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row" x-data>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <p class="mb-0">
                            Showing list of all Fees for group - {{ $terminalGroup->name }}
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <div class="table-responsive signal-table">
                                <table class="table table-hover sm:mt-2">
                                    <thead>
                                    <tr>
                                        <th >Title</th>
                                        <th >Type</th>
                                        <th >Amount</th>
                                        <th >Amount Type</th>
                                        <th >Cap</th>
                                        <th >Config</th>
                                        <th>
                                            <span class="f-light f-w-600">
                                                <i class="fa fa-cogs"></i>
                                            </span>
                                        </th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach ($terminalGroup->fees as $fee)
                                        <tr>
                                            <td class="">{{ $fee->title }}</td>
                                            <td class="">
                                                <x-badge :color="$fee->isCommission() ? 'warning': 'danger'">
                                                    {{ $fee->type }}
                                                </x-badge>
                                            </td>
                                            <td class="">{{ $fee->amount }}</td>
                                            <td class=""><x-badge>{{ $fee->amount_type }}</x-badge></td>
                                            <td class="">@money($fee->cap)</td>
                                            <td class="w-auto">
                                                {{ $fee->config ? 'AVAILABLE' : 'N/A' }}
                                            </td>
                                            <td>
                                                <a href="{{ route('fees.edit', $fee) }}"
                                                   class="btn btn-info btn-sm d-flex align-items-center gap-1 px-2 py-1 w-fit"
                                                >
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
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
        </div>
    </div>
@endsection
