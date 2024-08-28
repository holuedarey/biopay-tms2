<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\VirtualAccount;
use App\Models\VirtualAccountCredit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VfdWebhook extends Controller
{
    public function __invoke(Request $request)
    {
        $reference = $request->get('reference');
       //log $request->all();
        if (VirtualAccountCredit::whereReference($reference)->exists()){
            Log::warning('VFD: DUPLICATE TRANSACTION', $request->all());
            exit('Duplicate');
        }

        $va = VirtualAccount::whereAccountNo($request->get('account_number'))->firstOrFail();

        $amount = $request->float('amount');
        //lookup up service for funding, pick service charges, remove from ammount
        // amount = amount - service charges;
        $va->credits()->create([
            'amount' => $amount, //fix
            'reference' => $reference,
            'provider' => 'VFD',
            'paid_at' => Carbon::parse($request->get('timestamp')),
            'info' => $request->get('originator_narration'),
            'meta' => $request->all()
        ]);

        $va->update(['balance' => $amount]);

        $info = $request->get('originator_narration') . ' | From ' . $request->get('originator_account_name');

        $va->user->wallet->credit($amount, Service::whereSlug('fundinginbound')->first(), $reference, $info);

        exit('Complete');
    }
}
