<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use App\Models\TerminalMonitoring;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class TerminalMonitorings extends Component
{
    use WithPagination;

    public bool $showAction = true;
    public string $search = '';



    protected $queryString = [
        'search' => ['except' => '', 'as' => 'q']
    ];

    public function updatingSearch()
    {
        $this->resetPage(); // Reset pagination on search
    }

    // protected $paginationTheme = 'tailwind';
    // public $component = 'Terminals Monitoring';

    public function render()
    {

        $terminals = TerminalMonitoring::latest()->with('terminal.agent')->searchBySerial($this->search)->get();

        // Log::info(json_encode($terminals,JSON_PRETTY_PRINT));

        return view('pages.terminal-monitoring.table', compact('terminals'));
    }
}
