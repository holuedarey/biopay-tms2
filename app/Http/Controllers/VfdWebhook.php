<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Terminal;
use App\Models\Transaction;
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
        Log::alert("VFD: TRANSACTION Request", $validatedData);

        // Check for duplicate transaction
        if (VirtualAccountCredit::where('reference', $reference)->exists()) {
            Log::alert('VFD: DUPLICATE TRANSACTION', $validatedData);
            return response()->json([
                'status' => 'error',
                'message' => 'Duplicate transaction',
            ], 409);
        }

        // Find the virtual account by account number
        $va = VirtualAccount::where('account_number', $validatedData['account_number'])->first();
        if (!$va) {
            Log::alert("VFD: Virtual account not found", ['account_number' => $validatedData['account_number']]);
            return response()->json([
                'status' => 'error',
                'message' => 'Virtual account not found',
            ], 404);
        }

        $amount = (float) $validatedData['amount'];

        // Retrieve the terminal instance associated with the user
        $userTerminal = Terminal::where('user_id', $va->user_id)->first();
        if (!$userTerminal) {
            Log::alert("VFD: Terminal not found for the user", ['user_id' => $va->user_id]);
            return response()->json([
                'status' => 'error',
                'message' => 'Terminal not found for the user',
            ], 404);
        }

        $group = $userTerminal->group;
        if (!$group) {
            Log::alert("VFD: Group not found for the terminal", ['terminal_id' => $userTerminal->id]);
            return response()->json([
                'status' => 'error',
                'message' => 'Group not found for the terminal',
            ], 404);
        }

        // Apply service charge
        $charge = $group->charge(Service::vfd(), $amount);
        $amountToCredit = $amount - $charge;

        // Record credit transaction
        $va->credits()->create([
            'amount' => $amountToCredit,
            'reference' => $reference,
            'provider' => 'VFD',
            'paid_at' => Carbon::parse($validatedData['timestamp']),
            'info' => $validatedData['originator_narration'],
            'meta' => $validatedData
        ]);

        // Update virtual account balance
        $va->update(['balance' => $va->balance + $amountToCredit]);

        // Credit wallet
        $info = $validatedData['originator_narration'] . ' | From ' . $validatedData['originator_account_name'];
        $va->user->wallet->credit(
            $amountToCredit,
            Service::whereSlug('fundinginbound')->first(),
            $reference,
            $info
        );

        // Log transaction
        Transaction::createSuccessFor(
            $userTerminal,
            Service::vfdService("vfd"),
            $amountToCredit,
            $amount,
            $reference,
            $validatedData['originator_narration'],
            "VFD"
        );

        Log::alert("VFD: Account funded successfully", $validatedData);

        return response()->json([
            'status' => 'success',
            'message' => 'Account funded successfully',
            'data' => [
                'reference' => $reference,
                'credited_amount' => $amountToCredit,
                'charged_amount' => $charge,
                'new_balance' => $va->balance,
            ],
        ]);
    }
}
