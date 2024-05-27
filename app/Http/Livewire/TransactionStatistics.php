<?php

namespace App\Http\Livewire;

use App\Http\Controllers\Wallets;
use App\Models\Terminal;
use App\Models\Transaction;
use App\Models\WalletTransaction;
use Livewire\Component;

class TransactionStatistics extends Component
{
    public string $filter = 'today';

    public function render()
    {
        $transactions = (object) [
            'total' => Transaction::successful()->filterByDateDesc($this->filter)->sum('amount'),
            'count' => Transaction::successful()->filterByDateDesc($this->filter)->count(),
        ];

        $revenue = Transaction::successful()->filterByDateDesc($this->filter)->sum('charge');

        // Credit and debit total amounts
        $type = WalletTransaction::filterByDateDesc($this->filter)->groupBy('action')
            ->selectRaw('action, sum(amount) as amount')
            ->pluck('amount', 'action');

        $services_stats = Transaction::successful()->filterByDateDesc($this->filter, 'transactions.created_at')
            ->sumAmountAndCountByService()->get();

        $stats_chart = $this->getDataForChart($services_stats);

        $terminals = Terminal::countByStatus();

        $this->dispatchBrowserEvent('dashboard-transaction-chart', [
            'values' => array_values($stats_chart)
        ]);

        $total_balance = Wallets::filterByDateDesc($this->filter)->sum('balance');

        return view('livewire.transaction-statistics', compact(['transactions', 'revenue', 'type', 'services_stats', 'terminals', 'stats_chart', 'total_balance']));
    }

    public function getDataForChart($data): array
    {
        return [
            'Airtime' => $data->where('slug', 'airtime')->first()?->amount ?? 0,
            'Cable TV' => $data->where('slug', 'cabletv')->first()?->amount ?? 0,
            'Cashout' => $data->where('slug', 'cashoutwithdrawal')->first()?->amount ?? 0,
            'Data' => $data->where('slug', 'internetdata')->first()?->amount ?? 0,
            'Electricity' => $data->where('slug', 'electricity')->first()?->amount ?? 0,
            'Transfer' => $data->where('slug', 'banktransfer')->first()?->amount ?? 0,
        ];
    }
}
