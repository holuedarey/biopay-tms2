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
            'bank_code' => ['required', 'string',
                Rule::exists('banks', 'code')->where('provider', $transferService::name())
            ],
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
        $bank = Bank::whereCode($bank_code)->whereProvider($transferService::name())->firstOrFail()->name;
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
}
