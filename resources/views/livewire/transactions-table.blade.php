@php($placeholder = ($type == 'all') ? 'name, email, reference, service' : ($type == 'wallet' ? 'name, email, reference, account number' : 'reference, service' ))

<div class="row" x-data>
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex flex-lg-row flex-column flex-wrap flex-sm-nowrap gap-4 align-items-lg-center justify-content-between">
                <p class="mb-0">
                    Showing list of all {{ $type == 'wallet' ? 'Wallet ' : '' }} transactions
                </p>

                <x-table-filter :placeholder="$placeholder" />
            </div>
            <div class="card-body">
                <div class="">
                    <div class="table-responsive signal-table">
                        <table class="table table-hover sm:mt-2">
                            <thead>
                            <tr>
                                @unless($type == 'single-user')
                                    <th >Name</th>
                                @else
                                    <th>Terminal</th>
                                @endunless

                                @if($type == 'wallet')
                                    <th><span style="width: 140px">Account Number</span></th>
                                @endif

                                <th >Amount</th>

                                @if($type == 'wallet')
                                    <th ><span style="width: 100px">Prev Balance</span></th>
                                    <th ><span style="width: 100px">New Balance</span></th>
                                    <th >Type</th>
                                @endif

                                @if(in_array($type, ['all', 'single-user']))
                                    <th scope="col">Charge</th>
                                    <th scope="col">Revenue</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Service</th>
                                    <th scope="col">Status</th>
                                @endif

                                @if($type == 'wallet')
                                    <th >Reason</th>
                                @endif

                                <th >Reference</th>
                                <th >Date</th>
                                <th >Info</th>
                            </tr>
                            </thead>

                            <tbody>
                            @forelse ($transactions as $transaction)
                                <tr>
                                    @unless($type == 'single-user')
                                        <td class="">
                                            <x-users.row-data :user="$transaction->agent" />
                                        </td>
                                    @else
                                        <td class="">
                                            {{ $transaction->terminal->device }} - {{ $transaction->terminal->tid }}
                                        </td>
                                    @endunless

                                    @if($type == 'wallet')
                                        <td class="">{{ $transaction->wallet->account_number }}</td>
                                    @endif

                                    <td class="text-info">@money($transaction->amount)</td>

                                    @if($type == 'wallet')
                                        <td class="text-secondary">@money($transaction->prev_balance)</td>

                                        <td class="text-success">@money($transaction->new_balance)</td>

                                        <td class="">
                                            <x-badge :value="$transaction->action->value" :color="statusColor($transaction->action)" />
                                        </td>
                                    @endif

                                    @if(in_array($type, ['all', 'single-user']))
                                        <?php $providerFee = providerCharges($transaction->total_amount, $transaction->service->name) ?>
                                        <td class="text-secondary">@money($transaction->total_amount - ($transaction->charge + ) )</td>
                                        <td class="text-secondary">@money($transaction->charge)</td>

                                        <td class="text-success">@money($transaction->total_amount)</td>

                                        <td class=""><x-badge>{{ $transaction->service->name }}</x-badge></td>

                                        <td class="text-yellow-600">
                                            <x-badge :value="$transaction->status->value" :color="statusColor($transaction->status)" />
                                        </td>
                                    @endif

                                    @if($type == 'wallet')
                                        <td>
                                            <x-badge :value="$transaction->type" :color="statusColor($transaction->type)" />
                                        </td>
                                    @endif

                                    <td class="">{{ $transaction->reference }}</td>

                                    <td class="">
                                        <span style="width: 100px">{{ $transaction->created_at->toDayDateTimeString() }}</span>
                                    </td>

                                    <td class=""><span class="text-truncate">{{ $transaction->info }}</span></td>
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
