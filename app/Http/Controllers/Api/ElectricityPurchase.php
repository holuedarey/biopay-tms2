<?php

namespace App\Http\Controllers\Api;

use App\Contracts\ElectricityServiceInterface;
use App\Helpers\General;
use App\Helpers\MyResponse;
use App\Helpers\Purchase;
use App\Helpers\WalletHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ElectricityPurchaseRequest;
use App\Models\Service;
use App\Models\Terminal;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ElectricityPurchase extends Controller
{
    public function distributors(ElectricityServiceInterface $electricityService)
    {
        return MyResponse::success('Available distributors fetched',
            $electricityService->distributors()->sortBy('name')->values());
    }

    public function validateMeter(Request $request, ElectricityServiceInterface $electricityService)
    {
        $request->validate([
            'amount' => 'required|numeric|min:100',
            'meterNo' => 'required|numeric|max_digits:20',
            'code' => 'required',
            'type' => 'required|in:prepaid,postpaid'
        ]);

        $meterNo = $request->meterNo;
        $terminal = Terminal::whereSerial($request->header('deviceId'))->firstOrFail();

        $charge = $terminal->group->charge(Service::electricity(), $request->amount);

        $res = $electricityService->validateMeter($meterNo, $request->code, $request->type, $request->amount);

        return MyResponse::success('Meter validated.', $res->put('charge', $charge));
    }

    public function purchase(ElectricityPurchaseRequest $request, ElectricityServiceInterface $electricityService)
    {
        $reference = General::generateReference();
        $phone = $request->get('phone');
        $amount = (double) $request->get('amount');
        $code = $request->get('code');
        $meter = $request->get('meterNo');

        $narration = 'Payment for ' . strtoupper($code)  ." electricity bill: $meter - " . moneyFormat($amount);

        $group = $request->terminal->group;
        $charge = $group->charge($service = Service::electricity(), $amount);
        $totalAmount = $amount + $charge;

        // save transaction
        $transaction = Transaction::createPendingFor(
            $request->terminal,
            $service,
            $amount,
            $totalAmount,
            $reference,
            $narration,
            $electricityService::name()
        );

        return Purchase::process($transaction, $request->wallet,
            fn () => WalletHelper::processDebit($request->wallet, $amount, $service, $reference, $narration, $charge, $group),
            fn() => $electricityService->purchaseEleco($amount, $phone, $reference, $request->paymentData)
        );
    }
}
