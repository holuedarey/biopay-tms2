<?php

namespace App\Http\Livewire;

use App\Models\TerminalMonitoring;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class TerminalToggle extends Component
{

    public $terminal;
    public $isActive;
    public $terminalId;

    public function mount($terminalId)
    {
        $this->terminalId = $terminalId;
        $this->terminal = TerminalMonitoring::findOrFail($terminalId);
        $this->isActive = $this->terminal->is_active;
    }

    // public function toggleStatus()
    // {
    //     $this->terminal = TerminalMonitoring::findOrFail($this->terminalId);

    //     // Toggle between ACTIVE and INACTIVE
    //     $this->isActive = !$this->terminal->terminal->is_active;
    //     $this->terminal->terminal->is_active = $this->isActive;
    //     $this->terminal->terminal->changeStatus();
    // }

    public function render()
    {
        return view('livewire.terminal-toggle');
    }

    public function toggleStatus()
    {


        $this->isActive = !$this->isActive;
        $this->terminal = TerminalMonitoring::findOrFail($this->terminalId);
        if (!$this->terminal->terminal->agent->is_active && !$this->terminal->terminal->is_active) {
            $this->dispatchBrowserEvent('error', [
                'message' => "Cannot change status because {$this->terminal->terminal->agent->name} is {$this->terminal->terminal->agent->status}."
            ]);
        } else {
            $this->terminal->terminal->changeStatus();

            $name = class_basename($this->terminal->terminal);
            $msg = $name == 'Wallet' ? ' status updated.' : ' status update awaiting approval.';
            $this->dispatchBrowserEvent('pending', ['message' => $name . $msg]);
        }

        $this->emit('refresh');
    }
}
