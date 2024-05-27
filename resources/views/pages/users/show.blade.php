@extends('layouts.simple.master')

@section('title', 'Manage Users')

@section('breadcrumb-title')
    <h3>{{ $user->roleName }}</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">{{ $user->roleName }}</li>
@endsection

@section('content')
    @php($terminal = $user->terminals->first())
    <div class="container-fluid" x-data="{action: '', terminal: @js($terminal)}">
        <div class="row">
            <div class="col-xl-8 col-lg-12 col-md-9 col-12">
                <div class="card widget-1">
                    <div class="card-body py-4">
                        <ul class="user-list">
                            <li>
                                <div class="social-img-wrap">
                                    <div class="social-img"><img src="{{ $user->avatar }}" alt="profile"></div>
                                </div>
                                <div class="px-3">
                                    <h5 class="mb-2">{{ $user->name }}</h5>
                                    <div>
                                        <livewire:user-status-badge :user="$user"/>
                                        @can('update', $user)
                                            <a href="{{ route('users.edit', $user) }}"
                                               class="pt-2 text-dark d-block"
                                            ><i class="fa fa-edit text-info "></i> Edit Profile</a>
                                        @endcan
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <p class="d-flex align-items-center mb-1"><i class="icon-envelope text-danger me-2"></i><span>{{ $user->email }}</span></p>
                                    <p class="d-flex align-items-center mb-1"><i class="fa fa-phone text-primary me-2"></i><span>{{ $user->phone }}</span></p>
                                    <p class="d-flex align-items-center mb-1"><i class="icon-map text-success me-2"></i><span>{{ $user->address ?? '...'}}</span></p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card social-widget">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-2">
                                <div class="social-icons">
                                    <i class="fa fa-credit-card"></i>
                                </div>
                            </div>
                            <livewire:status-toggle-badge :model="$user->wallet" />
                        </div>
                        <div class="social-content mt-1">
                            <h5 class="mb-1">@money($user->wallet->balance)</h5>
                            <span class="f-light">Wallet Balance</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header py-3 d-flex justify-content-between">
                        <p class="mb-0 fw-medium text-secondary">Transaction Summary</p>

                        <a href="{{ route('statistics', $user) }}" class="small">View Statistics</a>
                    </div>

                    <div class="card-body">
                        <div class="d-flex">
                            <div class="me-auto">
                                <p class="fw-medium mb-0">@money($transactions->today->amount_sum)</p>
                                <div class="text-secondary">Today</div>
                            </div>
                            <div class="d-flex">
                                <div class="text-center">
                                    <div class="bg-light-success text-success rounded px-2 mt-1">{{ $transactions->today->count }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex mt-2">
                            <div class="me-auto">
                                <p class="fw-medium mb-0">@money($transactions->week->amount_sum)</p>
                                <div class="text-secondary">This week</div>
                            </div>
                            <div class="d-flex">
                                <div class="text-center">
                                    <div class="bg-light-info text-info rounded px-2 mt-1">{{ $transactions->week->count }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex mt-2">
                            <div class="me-auto">
                                <p class="fw-medium mb-0">@money($transactions->month->amount_sum)</p>
                                <div class="text-secondary">This Month</div>
                            </div>
                            <div class="d-flex">
                                <div class="text-center">
                                    <div class="bg-light-warning text-warning rounded px-2 mt-1">{{ $transactions->month->count }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex mt-2">
                            <div class="me-auto">
                                <p class="fw-medium mb-0">@money($transactions->year->amount_sum)</p>
                                <div class="text-secondary">This year</div>
                            </div>
                            <div class="d-flex">
                                <div class="text-center">
                                    <div class="bg-light-dark text-dark rounded px-2 mt-1">
                                        {{ $transactions->year->count }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header py-3 d-flex justify-content-between">
                        <p class="mb-0 fw-medium text-secondary">Terminal Details</p>

                        <div> Referral Code - <strong>{{ $user->referral_code }}</strong></div>
                    </div>

                    <div class="card-body pt-3">
                        @if($user->super_agent_id)


                            <div class="shadow-sm px-3 py-1 rounded mb-3">
                                <div class="d-flex gap-2">
                                    <p class="me-auto mb-0">
                                        {{ $user->superAgent->name }} - {{ $user->superAgent->email }}
                                        <br>
                                        <span class="small font-medium text-secondary">{{ \App\Models\Role::SUPERAGENT }}</span>
                                    </p>
                                    <button type="button" class="btn btn-sm bg-light-info px-2 text-info me-2 h-fit"
                                            data-bs-toggle="modal" data-bs-target="#edit-super-agent"
                                            x-on:click="action = '{{ route('terminals.update', $terminal || []) }}'"
                                    >
                                        <i class="fa fa-edit"></i> Change
                                    </button>
                                </div>
                            </div>
                        @endif

                        @if($terminal)
                            <div class="shadow-sm px-3 py-1 rounded" x-data="terminal_update">
                                <div class="d-flex gap-2">
                                    <p class="me-auto mb-0">
                                        {{ $terminal->device }} - {{ $terminal->tid }}
                                        <br>
                                        <span class="small text-secondary">Terminal Serial: {{ $terminal->serial }}</span>
                                    </p>
                                    @can('update', $terminal)
                                        <div>
                                            <button type="button" class="btn btn-sm bg-light-info px-2 text-info me-2"
                                                    data-bs-toggle="modal" data-bs-target="#edit-terminal"
                                                    x-on:click="action = '{{ route('terminals.update', $terminal) }}'"
                                            >
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm bg-light-primary px-2 txt-primary"
                                                    data-bs-toggle="modal" data-bs-target="#edit-menus"
                                                    x-on:click="initializeModal('{{ route('terminals.menus.index', $terminal) }}')"
                                            >
                                                <i class="fa fa-list"></i>
                                            </button>
                                        </div>
                                    @endcan
                                </div>

                                <x-terminals.menus />
                            </div>
                        @else
                            <div class="shadow-sm p-3 rounded">
                                <div class="d-flex gap-2">
                                    <p class="me-auto">No terminal for this user...</p>
{{--                                    <button class="btn btn-sm bg-light-info px-2 txt-info h-fit"--}}
{{--                                            data-bs-toggle="modal" data-bs-target="#create-terminal"--}}
{{--                                    >--}}
{{--                                        <i class="fa fa-plus"></i>--}}
{{--                                    </button>--}}
                                    <button type="button"
                                            class="btn btn-sm bg-light-info px-2 txt-info h-fit"
                                            data-bs-toggle="modal" data-bs-target="#add-terminal"
                                    >
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        @endif

                        <div class="mt-3">
                            <div class="d-flex flex-col flex-sm-row justify-content-between align-items-center">
                                <div>
                                    <x-badge>{{ $user->kycLevel->name }} Level</x-badge>
                                </div>

                                <a href="{{ route('users.kyc.index', $user) }}"
                                   class="btn btn-sm btn-outline-primary btn-hover-effect"
                                >Manage KYC</a>
                            </div>
                            <div class="progress sm-progress-bar overflow-visible mt-2">
                                <div class="progress-bar-animated bg-info rounded-pill progress-bar-striped"
                                     role="progressbar"
                                     aria-valuenow="{{ $id = $user->kycLevel->id }}"
                                     aria-valuemin="1"
                                     aria-valuemax="{{ $level_count = app('levels')->count() }}"
                                     style="width: {{ $id/$level_count * 100 }}%"></div>
                            </div>
                            <p class="small">
                                <i class="fa fa-info-circle"></i>
                                Manage KYC to update level, view the documents and requirements.
                            </p>
                        </div>

                        <div class="text-center mt-1">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- BEGIN: General Statistic -->
        <section>
            <livewire:transactions-table type="single-user" :user="$user" />
        </section>
        <!-- END: General Statistic -->

        @can('update', $terminal)
            <x-terminals.edit />
        @endcan

        <div class="modal fade" id="edit-super-agent" tabindex="-1" role="dialog" aria-labelledby="edit-super-agent" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form class="modal-content my-form" action="{{ route('change-super-agent', $user) }}" method="post">
                    @csrf
                    <div class="modal-header fw-medium">
                        Change {{ \App\Models\Role::SUPERAGENT }}
                        <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Enter the referral code of the {{ \App\Models\Role::SUPERAGENT }} you want to assign to this
                            {{ \App\Models\Role::AGENT }} account.</p>
                        <div class="mt-3">
                            <label for="referral_code" class="form-label">Referral Code</label>
                            <div class="w-100">
                                <input id="referral_code" type="text" class="form-control" name="referral_code" required>
                                <x-input-error input-name="referral_code" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-right mt-2">
                        <button class="btn btn-outline-light" type="button" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-primary btn-hover-effect" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
        @props(['terminals', 'group' => null, 'email' => $user->email])
        @can('create', \App\Models\Terminal::class)
            <x-terminals.create :$group />
        @endcan

        <x-terminals.edit />
        <x-terminals.menus />
    </div>

@endsection
