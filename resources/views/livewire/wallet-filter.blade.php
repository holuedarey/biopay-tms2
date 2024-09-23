@php($placeholder = ($type == 'all') ? 'name, email, reference, service' : ($type == 'wallet' ? 'name, email, reference, account number' : 'reference, service'))

<div class="row" x-data>
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex flex-lg-row flex-column flex-wrap flex-sm-nowrap gap-4 align-items-lg-center justify-content-between">
                <p class="mb-0">
                    Showing list of all {{ $type == 'wallet' ? 'Wallet ' : '' }} transactions
                </p>

                {{-- Table Filter Component with dynamic placeholder --}}
                <x-table-filter :placeholder="$placeholder" />
            </div>

            <div class="card-body">
                <div class="table-responsive signal-table">
                    <table class="table table-hover sm:mt-2">
                        <thead>
                        <tr>
                            {{-- Conditionally show Name or Terminal column --}}
                            @unless($type == 'single-user')
                                <th>Name</th>
                            @else
                                <th>Terminal</th>
                            @endunless

                            {{-- Wallet Specific Columns --}}
                            @if($type == 'wallet')
                                <th>Account Number</th>
                            @endif

                            <th>Amount</th>

                            @if($type == 'wallet')
                                <th>Prev Balance</th>
                                <th>New Balance</th>
                                <th>Type</th>
                            @endif

                            {{-- Common for "all" and "single-user" types --}}
                            @if(in_array($type, ['all', 'single-user']))
                                <th>Charge</th>
                                <th>Total</th>
                                <th>Service</th>
                                <th>Status</th>
                            @endif

                            {{-- Wallet Specific Reason --}}
                            @if($type == 'wallet')
                                <th>Reason</th>
                            @endif

                            <th>Reference</th>
                            <th>Date</th>
                            <th>Info</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse ($transactions as $transaction)
                            <tr>
                                {{-- Render Name or Terminal --}}
                                @unless($type == 'single-user')
                                    <td>
                                        <x-users.row-data :user="$transaction->agent" />
                                    </td>
                                @else
                                    <td>
                                        {{ $transaction->terminal->device }} - {{ $transaction->terminal->tid }}
                                    </td>
                                @endunless

                                {{-- Wallet-specific Account Number --}}
                                @if($type == 'wallet')
                                    <td>{{ $transaction->wallet->account_number }}</td>
                                @endif

                                <td class="text-info">@money($transaction->amount)</td>

                                {{-- Wallet-specific Prev/New Balance and Type --}}
                                @if($type == 'wallet')
                                    <td class="text-secondary">@money($transaction->prev_balance)</td>
                                    <td class="text-success">@money($transaction->new_balance)</td>
                                    <td>
                                        <x-badge :value="$transaction->action->value" :color="statusColor($transaction->action)" />
                                    </td>
                                @endif

                                {{-- Common for all and single-user --}}
                                @if(in_array($type, ['all', 'single-user']))
                                    <td class="text-secondary">@money($transaction->charge)</td>
                                    <td class="text-success">@money($transaction->total_amount)</td>
                                    <td><x-badge>{{ $transaction->service->name }}</x-badge></td>
                                    <td>
                                        <x-badge :value="$transaction->status->value" :color="statusColor($transaction->status)" />
                                    </td>
                                @endif

                                {{-- Wallet-specific Reason --}}
                                @if($type == 'wallet')
                                    <td>
                                        <x-badge :value="$transaction->type" :color="statusColor($transaction->type)" />
                                    </td>
                                @endif

                                <td>{{ $transaction->reference }}</td>
                                <td>{{ $transaction->created_at->toDayDateTimeString() }}</td>
                                <td><span class="text-truncate">{{ $transaction->info }}</span></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="text-center">No transactions</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination Links --}}
                <div class="mt-3">
                    {{ $transactions->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
