<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Activitylog\Models\Activity;

class ActivityLog extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {

        $activities = Activity::latest()->paginate();
        return view('livewire.activity-log', compact('activities'));
    }
}
