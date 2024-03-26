<?php

namespace App\Http\Livewire;

use App\Models\VirtualAccountCredit;
use Livewire\Component;
use Livewire\WithPagination;

class VirtualAccountFunding extends Component
{
    use WithPagination;

    public function render()
    {
        $credits = VirtualAccountCredit::with('account.user')->paginate();

        return view('livewire.virtual-account-funding', compact('credits'));
    }
}
