<?php

namespace App\Http\Controllers\Api;

use App\Contracts\CableTvServiceInterface;
use App\Helpers\General;
use App\Helpers\MyResponse;
use App\Helpers\Purchase;
use App\Helpers\WalletHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CableTvPurchaseRequest;
use App\Models\Service;
use App\Models\Terminal;
use App\Models\Transaction;
use Illuminate\Http\Request;

class CableTvPurchase extends Controller
{
    public function plans(Request $request, CableTvServiceInterface $cableTvService)
    {
        $request->validate(['decoder' => 'required|in:dstv,gotv,startimes']);

        return MyResponse::success(
            strtoupper($request->decoder) . ' plans loaded',
            $cableTvService->getBouquetPlans($request->decoder)->sortBy('price')->values()
        );
    }


    public function validateAccount(Request $request, CableTvServiceInterface $cableTvService)
    {
        $request->validate([
            'account_id' => 'required',
            'decoder' => 'required|in:dstv,gotv,startimes',
            'amount' => 'required|numeric|min:400'
        ]);

        $terminal = Terminal::whereSerial($request->header('deviceId'))->firstOrFail();

        $charge = $terminal->group->charge(Service::cableTv(), $request->amount);

        $res = $cableTvService->validatePlan($request->decoder, $request->account_id, $request->type);

        return MyResponse::success('Validation complete.', $res->put('charge', $charge));
    }


    public function purchase(CableTvPurchaseRequest $request, CableTvServiceInterface $cableTvService)
    {
        $reference = General::generateReference();
        $amount = (double) $request->get('amount');
        $decoder = $request->get('decoder');
        $phone = $request->get('phone');
        $planCode = $request->get('planCode');

        $narration = 'Purchase for ' . strtoupper($decoder)  .": $planCode - " . moneyFormat($amount) . " for {$request->account_id}";

        $group = $request->terminal->group;
        $charge = $group->charge($service = Service::cableTv(), $amount);
        $totalAmount = $amount + $charge;

        // save transaction
        $transaction = Transaction::createPendingFor(
            $request->terminal,
            $service,
            $amount,
            $totalAmount,
            $reference,
            $narration,
            $cableTvService::name()
        );

        return Purchase::process($transaction, $request->wallet,
            fn () => WalletHelper::processDebit($request->wallet, $amount, $service, $reference, $narration, $charge, $group),
            fn() => $cableTvService->purchasePlan($decoder, $planCode, $phone, $amount, $reference, $request->months, $request->paymentData)
        );
    }
}
