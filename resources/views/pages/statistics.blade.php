@extends('layouts.simple.master')

@section('title', 'Statistics')

@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@section('breadcrumb-title')
    <h3>Statistics</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    @if($user)
        <li class="breadcrumb-item"><a href="{{ $user_route = route('users.show', $user) }}">{{ $user->name }}</a></li>
    @endif
    <li class="breadcrumb-item active">Statistics</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            @if($user)
                <div class="col">
                    <p>Showing statistics for <a href="{{ $user_route }}"><span class="fw-medium">{{ $user->name }}</span> - <i>{{ $user->email }}</i></a></p>
                </div>
            @endif

            <div class="col">
                <div class="d-flex gap-2 justify-content-end">
                    <form action="">
                        <select name="period" onchange="this.closest('form').submit()"
                                class="form-control form-select w-32 bg-transparent border-black border-opacity-10 mx-auto sm:mx-0 px-3"
                        >
                            <option value="today" @selected(request('period') == 'today')>Today</option>
                            <option value="yesterday" @selected(request('period') == 'yesterday')>Yesterday</option>
                            <option value="week" @selected(request('period') == 'week')>This week</option>
                            <option value="month" @selected(request('period') == 'month')>This month</option>
                            <option value="year" @selected(request('period') == 'year')>This year</option>
                            <option value="all" @selected(request('period') == 'all')>Overall</option>
                        </select>
                    </form>

                    <form action="">
                        <div class="w-56">
                            <div class="input-group flatpicker-calender">
                                <input class="form-control bg-transparent" id="range-date" type="date"
                                       placeholder="Start date - End date"
                                       wire:model="date" aria-label="Date range filter"
                                >
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
                <livewire:statistics :user="$user" :period="request('period')" :date="request('date')" />
            </div>
            <!-- Individual column searching (text inputs) Ends-->
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/js/flat-pickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/js/flat-pickr/custom-flatpickr.js') }}"></script>
@endpush