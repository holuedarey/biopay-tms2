<?php

namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersList extends Component
{
    use WithPagination;

    public string $name;

    public string $search = '';

    protected $queryString = [
        'search' => ['except' => '', 'as' => 'q']
    ];

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $users = User::role($this->name)
            ->with('kycLevel')
            ->withSearch($this->search)
            ->latest()
            ->paginate(12);

        return view('livewire.users-list', compact('users'));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
