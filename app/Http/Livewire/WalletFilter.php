<?php

namespace App\Http\Livewire;

use App\Models\Transaction;
use App\Models\User;
use App\Models\WalletTransaction;
use Livewire\Component;
use App\Models\Wallet;
use Livewire\WithPagination;

class WalletFilter extends Component
{
    use WithPagination;

    public ?User $user = null;
    public string $type = 'all';
    public string $search = '';
    public string $date = '';
    public ?array $date_filter = null;

    // New filters for wallet transactions
    public string $account_number = '';
    public string $name = '';
    public string $status = '';

    protected $queryString = [
        'search' => ['except' => '', 'as' => 'q'],
    ];

    protected $paginationTheme = 'bootstrap';

    // Reset pagination when the search changes
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $transactions = match ($this->type) {
            'wallet' => $this->getWalletTransactions(),
            'all' => $this->getTransactions(),
            'single-user' => $this->getUserTransaction(),
            default => [],
        };

        return view('livewire.wallet-filter', compact('transactions'));
    }

    // Get wallet transactions with additional filters (account number, name, status)
    private function getWalletTransactions()
    {
        return WalletTransaction::latest()->with(['wallet', 'agent'])
            ->successful() // Assume this is a local scope
            ->when($this->search, fn($query) => $query->withSearch($this->search)) // Search filter
            ->when($this->account_number, fn($query) => $query->whereHas('wallet', function ($query) {
                $query->where('account_number', 'like', '%' . $this->account_number . '%');
            })) // Filter by account number
            ->when($this->name, fn($query) => $query->whereHas('agent', function ($query) {
                $query->where('name', 'like', '%' . $this->name . '%');
            })) // Filter by agent name
            ->when($this->status, fn($query) => $query->where('status', $this->status)) // Filter by status
            ->filterByDate($this->date_filter) // Date filter
            ->paginate();
    }

    // Get all transactions
    private function getTransactions()
    {
        return Transaction::latest()->with(['terminal', 'agent'])
            ->when($this->search, fn($query) => $query->withSearch($this->search)) // Search filter
            ->filterByDate($this->date_filter) // Date filter
            ->paginate();
    }

    // Get transactions for a single user
    private function getUserTransaction()
    {
        return $this->user->transactions()->latest()
            ->with('terminal')
            ->when($this->search, fn($query) => $query->withSearch($this->search)) // Search filter
            ->filterByDate($this->date_filter) // Date filter
            ->paginate();
    }

    // Filter date range
    public function filterDate(string $date = null): void
    {
        $this->date = $date ?? '';

        $this->date_filter = $date ? explode(' - ', $date) : null;
    }
}
