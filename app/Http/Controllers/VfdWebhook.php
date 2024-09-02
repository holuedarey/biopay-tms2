<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Terminal;
use App\Models\VirtualAccount;
use App\Models\VirtualAccountCredit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VfdWebhook extends Controller
{
    public function __invoke(Request $request)
    {
        // Validate incoming request
        $validatedData = $request->validate([
            'reference' => 'required|string',
            'amount' => 'required|numeric',
            'account_number' => 'required|string',
            'originator_account_number' => 'required|string',
            'originator_account_name' => 'required|string',
            'timestamp' => 'required|date',
            'originator_narration' => 'nullable|string'
        ]);

        $reference = $validatedData['reference'];

        // Log the transaction request
        Log::info("VFD: TRANSACTION Request", $validatedData);

        if (VirtualAccountCredit::where('reference', $reference)->exists()) {
            Log::warning('VFD: DUPLICATE TRANSACTION', $validatedData);
            exit('Duplicate');
        }

       // Find the virtual account by account number
        $va = VirtualAccount::where('account_number', $validatedData['account_number'])->firstOrFail();

        dd($va);
        // Get the amount from the request
        $amount = (float) $validatedData['amount'];

        // Look up the service for funding, apply service charges, and subtract from the amount
        // Assuming service charges are fetched and applied here
        // $serviceCharges = ...;
        // $amount -= $serviceCharges;

        $userGroup = Terminal::where('user_id', $va->user_id);
        $charge = $userGroup->group->charge(Service::vfd(), $amount);

        dd($charge);


        // Record the credit in the virtual account's credits
        $va->credits()->create([
            'amount' => $amount,
            'reference' => $reference,
            'provider' => 'VFD',
            'paid_at' => Carbon::parse($validatedData['timestamp']),
            'info' => $validatedData['originator_narration'],
            'meta' => $validatedData
        ]);

        // Update the virtual account's balance
        $va->update(['balance' => $va->balance + $amount]);

        // Prepare the information string for the wallet credit
        $info = $validatedData['originator_narration'] . ' | From ' . $validatedData['originator_account_name'];

        // Credit the user's wallet
        $va->user->wallet->credit($amount, Service::whereSlug('fundinginbound')->first(), $reference, $info);

        exit('Complete');
    }

}
