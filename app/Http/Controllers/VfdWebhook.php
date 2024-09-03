<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Terminal;
use App\Models\VirtualAccount;
use App\Models\VirtualAccountCredit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Telescope\Http\Controllers\LogController;

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


        Log::alert("VFD: TRANSACTION Request", $validatedData);

        if (VirtualAccountCredit::where('reference', $reference)->exists()) {
            Log::alert('VFD: DUPLICATE TRANSACTION', $validatedData);
            exit('Duplicate');
        }

       // Find the virtual account by account number
        $va = VirtualAccount::where('account_number', $validatedData['account_number'])->firstOrFail();


        // Get the amount from the request
        $amount = (float) $validatedData['amount'];

        // Look up the service for funding, apply service charges, and subtract from the amount
        // Assuming service charges are fetched and applied here
        // $serviceCharges = ...;
        // $amount -= $serviceCharges;

// Retrieve the terminal instance associated with the user
        $userTerminal = Terminal::where('user_id', $va->user_id)->first(); // Fetch the first matching terminal

        if ($userTerminal) {
            // Ensure the group relationship is loaded
            $group = $userTerminal->group;

            // Check if the group is available
            if ($group) {
                // Call the charge method on the group with the service and amount
                $charge = $group->charge(Service::vfd(), $amount);


            } else {
                // Handle case where the group is not found
                Log::alert("VFD: Group not found for the terminal");
                exit('VFD: Group not found for the terminal');
               // dd('Group not found for the terminal.');
            }
        } else {
            // Handle case where the terminal is not found
            Log::alert("VFD: Terminal not found for the user.");
            exit('VFD: Terminal not found for the user.');
        }

        $amountToCredit = $amount - $charge;

       // dd($amountToCredit);
        // Record the credit in the virtual account's credits
        $va->credits()->create([
            'amount' => $amountToCredit,
            'reference' => $reference,
            'provider' => 'VFD',
            'paid_at' => Carbon::parse($validatedData['timestamp']),
            'info' => $validatedData['originator_narration'],
            'meta' => $validatedData
        ]);

        // Update the virtual account's balance
        $va->update(['balance' => $va->balance + $amountToCredit]);

        // Prepare the information string for the wallet credit
        $info = $validatedData['originator_narration'] . ' | From ' . $validatedData['originator_account_name'];

        // Credit the user's wallet
        $va->user->wallet->credit($amountToCredit, Service::whereSlug('vfd')->first(), $reference, $info);
        Log::alert("VFD: Account funded successfully.", $validatedData);
        exit('Complete');
    }

}
