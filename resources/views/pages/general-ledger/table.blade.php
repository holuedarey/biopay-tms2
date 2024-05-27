<div class="col-12 mt-3">
    <div class="card">
        <div class="card-header d-flex flex-lg-row flex-column flex-wrap flex-sm-nowrap gap-4 align-items-lg-center justify-content-between">
            <p class="mb-0">Showing list of {{ $name }} General Ledger Transactions</p>

            <x-table-filter :show-search="false" />
        </div>

        <div class="card-body">
            <div class="">
                <div class="table-responsive signal-table">
                    <table class="table table-hover sm:mt-2">
                        <thead>
                        <tr class="bg-gray-200">
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Prev Balance</th>
                            <th>New Balance</th>
                            @if(is_null($gl))
                                <th>Service</th>
                            @endif
                            <th>Type</th>
                            <th>Info</th>
                            <th>Date</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($glts as $glt)
                            <tr class="intro-x">
                                <td class="whitespace-nowrap">
                                    <a href="{{ $glt->user ? route('users.show', $glt->user) : '#' }}"
                                       class="text-blue-600"
                                       title="{{ $glt->user?->email }}"
                                    >
                                        {{ ucwords($glt->user?->name) }}
                                    </a>
                                </td>
                                <td class="text-info">@money($glt->amount)</td>
                                <td class="text-danger">@money($glt->prev_balance)</td>
                                <td class="text-blue-600">@money($glt->new_balance)</td>
                                @if(is_null($gl))
                                    <td class="">
                                        <x-badge :value="$glt->generalLedger->service->name" />
                                    </td>
                                @endif
                                <td class="">
                                    <x-badge :value="$glt->type->value" :color="statusColor($glt->type)" />
                                </td>
                                <td class="">{{ $glt->info }}</td>
                                <td class="">{{ $glt->created_at->toDateTimeString() }}</td>
                            </tr>
                        @empty
                            <tr class="intro-x"><td colspan="8" class="text-center">No Transaction has impacted the General Ledger</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $glts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
