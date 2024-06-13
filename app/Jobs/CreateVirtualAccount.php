<?php

namespace App\Jobs;

use App\Contracts\VirtualAccountInterface;
use App\Models\User;
use App\Repository\Spout;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateVirtualAccount implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public User $user)
    {
        $this->queue = 'virtual-account';
    }

    /**
     * Execute the job.
     */
    public function handle(VirtualAccountInterface $virtualAccount): void
    {
        (new Spout())->createVirtualAccount($this->user);

//        $virtualAccount->createVirtualAccount($this->user);
    }
}
