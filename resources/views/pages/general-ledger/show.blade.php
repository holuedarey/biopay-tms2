@extends('layouts.simple.master')

@section('title', 'General Ledger')

@php($name = $gl->service->name)

@section('breadcrumb-title')
    <h5>{{ $name }} General Ledger</h5>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    @if(str($name)->lower()->contains('cashout'))
        <li class="breadcrumb-item active" aria-current="page">Main General Ledger</li>
    @else
        <li class="breadcrumb-item"><a href="{{ route('general-ledger.show') }}">Main General Ledgers</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $name }} General Ledger</li>
    @endif
@endsection

@section('content')
    <div class="container-fluid" x-data="{service: @js(request('service'))}">
        <div class="w-25 text-end mb-3">
            <select class="form-control form-select bg-transparent" x-model="service" id=""
                    x-on:change="location.href = @js(route('general-ledger.show')) + `?service=${service}`"
            >
                <option value="">-- Select other services -- </option>
                <option value="airtime">Airtime</option>
                <option value="internetdata">Internet Data</option>
                <option value="electricity">Electricity</option>
                <option value="cabletv">Cable TV</option>
                <option value="banktransfer">Bank Transfer</option>
            </select>
        </div>
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="card widget-hover">
                    <div class="card-body radial-progress-card">
                        <div>
                            <p class="mb-0">Available Balance</p>
                            <div class="sale-details">
                                <h5 class="font-dark mb-0">@money($gl->balance)</h5>
                            </div>
                        </div>
                        <div class="radial-chart-wrap text-end">
                            <div class="badge rounded-circle p-3 badge-light-info"
                                 style="cursor: pointer"
                            >
                                <i data-feather="plus"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card widget-hover">
                    <div class="card-body radial-progress-card">
                        <div>
                            <p class="mb-0">Total Credit</p>
                            <div class="sale-details">
                                <h5 class="font-dark mb-0">@money($sum['CREDIT'] ?? 0)</h5>
                            </div>
                        </div>
                        <div class="radial-chart-wrap text-end">
                            <div class="badge rounded-circle p-3 badge-light-success"
                                 style="cursor: pointer"
                            >
                                <i data-feather="plus"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card widget-hover">
                    <div class="card-body radial-progress-card">
                        <div>
                            <p class="mb-0">Total Debit</p>
                            <div class="sale-details">
                                <h5 class="font-dark mb-0">@money($sum['DEBIT'] ?? 0)</h5>
                            </div>
                        </div>
                        <div class="radial-chart-wrap text-end">
                            <div class="badge rounded-circle p-3 badge-light-danger"
                                 style="cursor: pointer"
                            >
                                <i data-feather="plus"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="mt-2">
            <livewire:gl-table :name="$name" :gl="$gl" />
        </section>
    </div>
@endsection
