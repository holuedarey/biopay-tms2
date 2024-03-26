<?php

namespace App\Jobs;

use App\Models\Service;
use App\Models\VirtualAccount;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class CreditVirtualAccount implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public VirtualAccount $virtualAccount, public Collection $data)
    {
        $this->queue = 'virtual-account';
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $amount = (float) $this->data['amount'] / 100;

        $credit = $this->virtualAccount->credits()->create([
            'amount'    => $amount,
            'reference' => $this->data['transaction_ref'],
            'provider'  => 'PAYGATE',
            'paid_at'   => $this->data['paid_at'],
            'info'      => $this->data->get('transaction_desc'),
            'meta'      => $this->data->only(['provider', 'data'])
        ]);

        $this->virtualAccount->balance += $amount;
        $this->virtualAccount->save();

        $this->virtualAccount->user->wallet->credit(
            $amount,
            Service::whereSlug('fundinginbound')->first(),
            $credit->reference,
            $credit->info
        );
    }
}
