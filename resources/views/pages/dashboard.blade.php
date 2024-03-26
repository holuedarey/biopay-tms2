@extends('layouts.simple.master')

@section('title', 'Dashboard')

@section('breadcrumb-title')
    <h3>Dashboard</h3>
@endsection

@section('content')
    <div class="container-fluid">
        <livewire:transaction-statistics />
        <div class="row widget-grid">
            <div class="col-xxl-4 col-md-6 appointment-sec box-col-6">
                <div class="appointment">
                    <div class="card">
                        <div class="card-header card-no-border">
                            <div class="header-top">
                                <h5 class="m-0">Recently added users</h5>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="appointment-table table-responsive">
                                <table class="table table-bordernone">
                                    <tbody>
                                    @foreach($agents as $agent)
                                        <tr>
                                            <td>
                                                <img class="img-fluid img-40 rounded-circle" src="{{ $agent->avatar }}" alt="user">
                                            </td>
                                            <td class="img-content-box">
                                                <a class="d-block f-w-500" href="{{ route('users.show', $agent) }}">{{ $agent->name }}</a>
                                                <span class="f-light" style="font-size: 10px">{{ $agent->email }}</span>
                                            </td>
                                            <td class="text-end">
                                                <x-badge>{{ $agent->role_name }}</x-badge>
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
            <div class="col-xxl-4 col-md-6 appointment-sec box-col-6">
                <div class="appointment">
                    <div class="card">
                        <div class="card-header card-no-border">
                            <div class="header-top">
                                <h5 class="m-0">Latest Transactions</h5>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="appointment-table table-responsive">
                                <table class="table table-bordernone">
                                    <tbody>
                                    @foreach($latest_transactions as $transaction)
                                        <tr>
                                            <td><img class="img-fluid img-30 rounded-circle" src="{{ $transaction->service->icon }}" alt="icon"></td>
                                            <td class="img-content-box">
                                                <a class="d-block f-w-500" href="#">{{ $transaction->agent->name }}</a>
                                                <span class="f-light small">{{ $transaction->created_at->diffForHumans() }}</span>
                                            </td>
                                            <td class="text-end">
                                                <p @class(['m-0',
                                                        'font-success' => $transaction->isSuccessful(),
                                                        'font-danger' => $transaction->isFailed(),
                                                        'font-warning' => $transaction->isPending()
                                                ])>@money($transaction->amount)</p>
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
            <div class="col-xxl-4 col-xl-5 col-md-6 col-sm-7 notification box-col-6">
                <div class="card height-equal">
                    <div class="card-header card-no-border">
                        <div class="header-top">
                            <h5 class="m-0">Activity Log</h5>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <ul>
                            @foreach($activities as $activity)
                                <li class="d-flex">
                                    <div class="activity-dot-primary"></div>
                                    <div class="w-100 ms-3">
                                        <p class="d-flex justify-content-between mb-2">
                                            <span class="date-content light-background">{{ $activity->created_at->format('dS F, y') }} </span>
                                            <span>{{ $activity->created_at->diffForHumans() }}</span></p>
                                        <h6>
                                            {{ ucfirst($activity->description) }} {{ ucwords(str_replace('-', ' ', $activity->log_name)) }}
                                            <span class="dot-notification"></span>
                                        </h6>
                                        <p class="f-light">{{ $activity->causer?->email }}</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/clock.js') }}"></script>
    <script src="{{ asset('assets/js/chart/apex-chart/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard/main.js') }}"></script>
{{--    <script src="{{ asset('assets/js/typeahead-search/typeahead-custom.js') }}"></script>--}}
    <script src="{{ asset('assets/js/height-equal.js') }}"></script>
    <script src="{{ asset('assets/js/animation/wow/wow.min.js') }}"></script>
@endsection
