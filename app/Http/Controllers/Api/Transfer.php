<?php

namespace App\Http\Controllers\Api;

use App\Contracts\TransferServiceInterface;
use App\Enums\Status;
use App\Helpers\General;
use App\Helpers\MyResponse;
use App\Helpers\Purchase;
use App\Helpers\WalletHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\TransferRequest;
use App\Models\Bank;
use App\Models\Service;
use App\Models\Terminal;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class Transfer extends Controller
{

    public function index(Request $request, TransferServiceInterface $transferService)
    {
        $terminal = Terminal::whereSerial($request->header('deviceId'))->firstOrFail();

        $request->validate([
            'account_number' => 'required|string|size:10',
            //'bank_code' => ['required', 'string',
              //  Rule::exists('banks', 'code')->where('provider', $transferService::name())
            //],
            'bank_code' => ['required', 'string'],
            'amount' => 'required|numeric|min:100'
        ]);

        $charge = $terminal->group->charge(Service::bankTransfer(), $request->amount);

        $res = $transferService->validateAccount($request->bank_code, $request->account_number);

        return $res->success ? MyResponse::success('Account validated', $res->data->put('charge', $charge)):
            MyResponse::failed($res->message);
    }

    /**
     * Handle the incoming request.
     */
    public function store(TransferRequest $request, TransferServiceInterface $transferService)
    {
        $reference = General::generateReference();

        $amount = (float) $request->get('amount');
        $bank_code = $request->get('bank_code');
        $bank = $request->get('bank_name');
//        $bank = Bank::whereCode($bank_code)->whereProvider($transferService::name())->firstOrFail()->name;
        $account_number = $request->get('account_number');
        $account_name = $request->get('account_name');

        $group = $request->terminal->group;
        $charge = $group->charge($service = Service::bankTransfer(), $amount);
        $totalAmount = $amount + $charge;

        // info
        $narration = $request->get('narration') ?? 'Fund transfer of '. moneyFormat($amount) . " from your Wallet to $account_number";

        // save transaction
        $transaction = auth()->user()->transactions()->create([
            'terminal_id'   => $request->terminal->id,
            'amount'        => $amount,
            'charge'        => $charge,
            'total_amount'  => $totalAmount,
            'bank_name'     => $bank,
            'bank_code'     => $bank_code,
            'account_number'=> $account_number,
            'account_name'  => $account_name,
            'reference'     => $reference,
            'info'          => $narration,
            'type_id'       => $service->id,
            'status'        => Status::PENDING,
            'provider'      => $transferService::name(),
            'version'       => request('VERSION'),
            'channel'       => request('CHANNEL'),
            'device'       => request('DEVICE'),
        ]);

        return Purchase::process(
            $transaction,
            $request->wallet,
            fn() => WalletHelper::processDebit($request->wallet, $amount, $service, $reference, $narration, $charge, $group),
            fn() => $transferService->transfer($bank_code, $account_number, $amount, $reference, $narration, $bank, $account_name, $transaction->id)
        );
    }

    public function downloadTransactions(Request $request)
    {
        // Validate the date range input
        $request->validate([
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
        ]);

        // Retrieve transactions based on the authenticated user and the provided date range
        $transactions = auth()->user()->transactions()
            ->whereBetween('created_at', [$request->start_date, $request->end_date])
            ->orderBy('created_at', 'desc')
            ->get();

        // Define the file name with the current timestamp
        $fileName = 'transactions_' . now()->format('Y_m_d_H_i_s') . '.csv';

        // Set the headers for downloading the file
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        // Callback function to create CSV content
        $callback = function() use ($transactions) {
            $file = fopen('php://output', 'w');

            // Add the CSV column headers
            fputcsv($file, ['Reference', 'Amount', 'Charge', 'Total Amount', 'Bank Name', 'Account Number', 'Status', 'Date']);

            // Add each transaction as a row in the CSV
            foreach ($transactions as $transaction) {
                fputcsv($file, [
                    $transaction->reference,
                    moneyFormat($transaction->amount),
                    moneyFormat($transaction->charge),
                    moneyFormat($transaction->total_amount),
                    $transaction->bank_name,
                    $transaction->account_number,
                    $transaction->status,
                    $transaction->created_at->format('Y-m-d H:i:s')
                ]);
            }

            fclose($file);
        };

        // Return the CSV download response
        return response()->stream($callback, 200, $headers);
    }

}
