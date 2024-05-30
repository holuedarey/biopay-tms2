<div class="row widget-grid">
    <div class="col-xxl-4 col-sm-6 box-col-6">
        <div class="card profile-box">
            <div class="card-body">
                <div class="media">
                    <div class="media-body">
                        <div class="greeting-user">
                            <h5 class="f-w-500">Good {{ now()->greet() . '  ' . Auth::user()->first_name }}</h5>
                            <p>Here's whats happening in your account</p>
                            <div>
                                <select wire:model="filter" class="form-select form-control bg-transparent w-50 text-white">
                                    <option value="today">Today</option>
                                    <option value="yesterday">Yesterday</option>
                                    <option value="week">This week</option>
                                    <option value="month">This month</option>
                                    <option value="year">This year</option>
                                    <option value="">Overall</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="clockbox">
                            <svg id="clock" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 600">
                                <g id="face">
                                    <circle class="circle" cx="300" cy="300" r="253.9"></circle>
                                    <path class="hour-marks" d="M300.5 94V61M506 300.5h32M300.5 506v33M94 300.5H60M411.3 107.8l7.9-13.8M493 190.2l13-7.4M492.1 411.4l16.5 9.5M411 492.3l8.9 15.3M189 492.3l-9.2 15.9M107.7 411L93 419.5M107.5 189.3l-17.1-9.9M188.1 108.2l-9-15.6"></path>
                                    <circle class="mid-circle" cx="300" cy="300" r="16.2"></circle>
                                </g>
                                <g id="hour">
                                    <path class="hour-hand" d="M300.5 298V142"></path>
                                    <circle class="sizing-box" cx="300" cy="300" r="253.9"></circle>
                                </g>
                                <g id="minute">
                                    <path class="minute-hand" d="M300.5 298V67"></path>
                                    <circle class="sizing-box" cx="300" cy="300" r="253.9"></circle>
                                </g>
                                <g id="second">
                                    <path class="second-hand" d="M300.5 350V55"></path>
                                    <circle class="sizing-box" cx="300" cy="300" r="253.9">   </circle>
                                </g>
                            </svg>
                        </div>
                        <div class="badge f-10 p-0" id="txt"></div>
                    </div>
                </div>
                <img class="img-fluid cartoon" width="150" src="{{ asset('assets/images/dashboard/cartoon.svg') }}" alt="vector women with leptop">
            </div>
        </div>
    </div>
    <div class="col-xxl-auto col-xl-3 col-sm-6 box-col-6">
        <div class="row">
            <div class="col-xl-12">
                <div class="card widget-1">
                    <div class="card-body">
                        <div class="widget-content">
                            <div class="widget-round success">
                                <div class="bg-round">
                                    <svg class="svg-fill">
                                        <use href="{{ asset('assets/svg/icon-sprite.svg#doller-return') }}"> </use>
                                    </svg>
                                    <svg class="half-circle svg-fill">
                                        <use href="{{ asset('assets/svg/icon-sprite.svg#halfcircle') }}"></use>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h6>@money($transactions->total)</h6>
                                <span class="f-light">Total - <span class="small">{{$transactions->count}}</span></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="card widget-1">
                        <div class="card-body">
                            <div class="widget-content">
                                <div class="widget-round primary">
                                    <div class="bg-round">
                                        <img src="{{ asset('assets/images/services/airtime.webp') }}" class="w-50" alt="">
                                        <svg class="half-circle svg-fill">
                                            <use href="{{ asset('assets/svg/icon-sprite.svg#halfcircle') }}"></use>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h6>@money($services_stats->where('slug', 'airtime')->first()?->amount ?? 0)</h6>
                                    <span class="f-light">Airtime -
                                        <span class="small">{{ $services_stats->where('slug', 'airtime')->first()?->count ?? 0 }}</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-auto col-xl-3 col-sm-6 box-col-6">
        <div class="row">
            <div class="col-xl-12">
                <div class="card widget-1">
                    <div class="card-body">
                        <div class="widget-content">
                            <div class="widget-round primary">
                                <div class="bg-round">
                                    <img src="{{ asset('assets/images/services/cashout.webp') }}" class="w-50" alt="">
                                    <svg class="half-circle svg-fill">
                                        <use href="{{ asset('assets/svg/icon-sprite.svg#halfcircle') }}"></use>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h6>@money($services_stats->where('slug', 'cashoutwithdrawal')->first()?->amount ?? 0)</h6>
                                <span class="f-light">Cashout -
                                        <span class="small">{{ $services_stats->where('slug', 'cashoutwithdrawal')->first()?->count ?? 0 }}</span>
                                    </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="card widget-1">
                        <div class="card-body">
                            <div class="widget-content">
                                <div class="widget-round primary">
                                    <div class="bg-round">
                                        <img src="{{ asset('assets/images/services/data.webp') }}" class="w-50" alt="">
                                        <svg class="half-circle svg-fill">
                                            <use href="{{ asset('assets/svg/icon-sprite.svg#halfcircle') }}"></use>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h6>@money($services_stats->where('slug', 'internetdata')->first()?->amount ?? 0)</h6>
                                    <span class="f-light">Data -
                                        <span class="small">{{ $services_stats->where('slug', 'internetdata')->first()?->count ?? 0 }}</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-auto col-xl-12 col-sm-6 box-col-6">
        <div class="row">
            <div class="col-xxl-12 col-xl-6 box-col-12">
                <div class="card widget-1">
                    <div class="card-body">
                        <div class="widget-content">
                            <div class="widget-round primary">
                                <div class="bg-round">
                                    <img src="{{ asset('assets/images/services/transfer.webp') }}" class="w-50" alt="">
                                    <svg class="half-circle svg-fill">
                                        <use href="{{ asset('assets/svg/icon-sprite.svg#halfcircle') }}"></use>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h6>@money($services_stats->where('slug', 'banktransfer')->first()?->amount ?? 0)</h6>
                                <span class="f-light">Transfer -
                                        <span class="small">{{ $services_stats->where('slug', 'banktransfer')->first()?->count ?? 0 }}</span>
                                    </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-12 col-xl-6 box-col-12">
                <div class="card widget-1">
                    <div class="card-body">
                        <div class="widget-content">
                            <div class="widget-round primary">
                                <div class="bg-round">
                                    <img src="{{ asset('assets/images/services/electricity.webp') }}" class="w-50" alt="">
                                    <svg class="half-circle svg-fill">
                                        <use href="{{ asset('assets/svg/icon-sprite.svg#halfcircle') }}"></use>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h6>@money($services_stats->where('slug', 'electricity')->first()?->amount ?? 0)</h6>
                                <span class="f-light">Bill Payments -
                                        <span class="small">{{ $services_stats->where('slug', 'electricity')->first()?->count ?? 0 }}</span>
                                    </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-8 col-lg-12 box-col-12">
        <div class="card">
            <div class="card-header card-no-border">
                <p>Chart showing total transaction amount of each service for the period.</p>
            </div>
            <div class="card-body pt-0">
                <div class="row m-0 overall-card">
                    <div class="col-xl-9 col-md-12 col-sm-7 p-0">
                        <div class="chart-right">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="card-body p-0">
                                        <div class="current-sale-container">
                                            <div id="stats-chart"
                                                 data-labels="{{ json_encode(array_keys($stats_chart)) }}"
                                                 data-values="{{ json_encode(array_values($stats_chart)) }}"
                                            ></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-12 col-sm-5 p-0">
                        <div class="row g-sm-4 g-2">
                            <div class="col-xl-12 col-md-4">
                                <div class="light-card balance-card widget-hover">
                                    <div> <span class="f-light">Overall Wallet Balance</span>
                                        <h6 class="mt-1 mb-0">@money($total_balance ?? 0)</h6>
                                    </div>
                                    <div class="ms-auto text-end">
                                        <span class="font-success"><i class="fa fa-circle"></i></span>
                                    </div>
                                </div>
                                <div class="light-card balance-card widget-hover">
                                    <div> <span class="f-light">Overall Revenue</span>
                                        <h6 class="mt-1 mb-0">@money($revenue ?? 0)</h6>
                                    </div>
                                    <div class="ms-auto text-end">
                                        <span class="font-success"><i class="fa fa-circle"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-sm-4 g-2">
                            <div class="col-xl-12 col-md-4">
                                <div class="light-card balance-card widget-hover">
                                    <div class="svg-box">
                                        <svg class="svg-fill">
                                            <use href="{{ asset('assets/svg/icon-sprite.svg#income') }}"></use>
                                        </svg>
                                    </div>
                                    <div> <span class="f-light">Credit</span>
                                        <h6 class="mt-1 mb-0">@money($type['CREDIT'] ?? 0)</h6>
                                    </div>
                                    <div class="ms-auto text-end">
                                        <span class="font-success"><i class="fa fa-circle"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-md-4">

                                <div class="light-card balance-card widget-hover">
                                    <div class="svg-box">
                                        <svg class="svg-fill">
                                            <use href="{{ asset('assets/svg/icon-sprite.svg#expense') }}"></use>
                                        </svg>
                                    </div>
                                    <div> <span class="f-light">Debit</span>
                                        <h6 class="mt-1 mb-0">@money($type['DEBIT'] ?? 0)</h6>
                                    </div>
                                    <div class="ms-auto text-end">
                                        <span class="font-danger"><i class="fa fa-circle"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-4 col-xl-7 col-md-6 col-sm-5 box-col-6">
        <div class="card height-equal">
            <div class="card-header card-no-border">
                <div class="header-top">
                    <h5>Terminals</h5>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="row recent-wrapper">
                    <div class="col-xl-6">
                        <div class="terminals-chart" wire:ignore>
                            <div id="terminalschart" data-values="{{ json_encode([$terminals->active, $terminals->inactive]) }}"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
