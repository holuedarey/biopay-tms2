<?php

namespace App\Http\Livewire;

use App\Models\Loan;
use Livewire\Component;
use Livewire\WithPagination;

class LoansTable extends Component
{
    use WithPagination;
    public function render()
    {
        $loans = Loan::with('agent')->viewable()->paginate();

        return view('livewire.loans-table', compact('loans'));
    }
}
