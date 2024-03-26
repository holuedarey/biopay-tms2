<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-sm-6 col-xl-3">
                <div class="card widget-1">
                    <div class="card-body">
                        <div class="widget-content">
                            <div class="widget-round success">
                                <div class="bg-round">
                                    <i class="fa fa-mail-reply text-success"></i>

                                    <svg class="half-circle svg-fill">
                                        <use href="{{ asset('assets/svg/icon-sprite.svg#halfcircle') }}"></use>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h6>@money($type['CREDIT'] ?? 0)</h6><span class="f-light">Total Credit</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card widget-1">
                    <div class="card-body">
                        <div class="widget-content">
                            <div class="widget-round secondary">
                                <div class="bg-round">
                                    <i class="fa fa-mail-forward text-danger"></i>
                                    <svg class="half-circle svg-fill">
                                        <use href="{{ asset('assets/svg/icon-sprite.svg#halfcircle') }}"></use>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h6>@money($type['DEBIT'] ?? 0)</h6><span class="f-light">Total Debit</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card widget-1">
                    <div class="card-body">
                        <div class="widget-content">
                            <div class="widget-round primary">
                                <div class="bg-round">
                                    <i class="icofont icofont-coins fs-5"></i>
                                    <svg class="half-circle svg-fill">
                                        <use href="../assets/svg/icon-sprite.svg#halfcircle"></use>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h5 class="text-success">@money($openingBalance)</h5><span class="f-light">Opening Balance</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card widget-1">
                    <div class="card-body">
                        <div class="widget-content">
                            <div class="widget-round primary">
                                <div class="bg-round">
                                    <i class="icofont icofont-coins fs-5"></i>
                                    <svg class="half-circle svg-fill">
                                        <use href="../assets/svg/icon-sprite.svg#halfcircle"></use>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h5 class="text-danger">@money($closingBalance)</h5><span class="f-light">Closing Balance</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-header d-flex flex-lg-row flex-column flex-wrap flex-sm-nowrap gap-4 align-items-lg-center justify-content-between">
                <p class="mb-0">
                    Wallet Transactions Ledger
                </p>

                <x-table-filter placeholder="by agent, service" />
            </div>

            <div class="card-body">
                <div class="">
                    <div class="table-responsive signal-table">
                        <table class="table table-hover sm:mt-2">
                            <thead>
                            <tr class="bg-secondary">
                                <th scope="col">Email</th>
                                <th scope="col">Service</th>
                                <th scope="col" class="whitespace-nowrap">Prev Balance</th>
                                <th scope="col">New Balance</th>
                                <th scope="col"><x-badge value="DEBIT" :color="statusColor(\App\Enums\Action::DEBIT)" /></th>
                                <th scope="col"><x-badge value="CREDIT" :color="statusColor(\App\Enums\Action::CREDIT)" /></th>
                                <th scope="col">Date</th>
                            </tr>
                            </thead>

                            <tbody>
                            @forelse ($transactions as $transaction)
                                <tr>
                                    <td class="">
                                        <p class="f-light">{{ $transaction->agent->email }}</p>
                                    </td>

                                    <td><x-badge>@nbsp($transaction->service->name)</x-badge></td>

                                    <td class="text-slate-500">@money($transaction->prev_balance)</td>

                                    <td class="text-blue-600">@money($transaction->new_balance)</td>

                                    <td class="">
                                        <span class="text-danger">@if($transaction->isDebit()) @money($transaction->amount) @endif</span>
                                    </td>

                                    <td class="">
                                        <span class="text-success">@if($transaction->isCredit()) @money($transaction->amount) @endif</span>
                                    </td>

                                    <td class="text-nowrap">{{ $transaction->created_at->toDayDateTimeString() }}</td>
                                </tr>
                            @empty
                                <tr class="intro-x"><td colspan="9" class="text-center">No transactions</td></tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $transactions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>