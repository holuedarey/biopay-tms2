<?php

namespace App\Http\Controllers\Api;

use App\Contracts\DataServiceInterface;
use App\Helpers\General;
use App\Helpers\MyResponse;
use App\Helpers\Purchase;
use App\Helpers\WalletHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\DataPurchaseRequest;
use App\Models\Service;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DataPurchase extends Controller
{
    public function index(Request $request, DataServiceInterface $dataService)
    {
        $request->validate(['network' => 'required|in:mtn,airtel,glo,9mobile']);

        $data_plans = $dataService->getDataPlans($request->network);

        return MyResponse::success(strtoupper($request->network) . ' data plans fetched.', $data_plans);
    }

    public function store(DataPurchaseRequest $request, DataServiceInterface $dataService)
    {
        $reference = General::generateReference();
        $amount = (double) $request->get('amount');
        $network = $request->get('network');
        $phone = $request->get('phone');

        $narration = 'Data purchase of ' . strtoupper($network) . ' - ' . moneyFormat($amount) . " for $phone";

        // save transaction
        $transaction = Transaction::createPendingFor(
            $request->terminal,
            $service = Service::internetData(),
            $amount,
            $amount,
            $reference,
            $narration,
            $dataService::name()
        );

        return Purchase::process(
            $transaction,
            $request->wallet,
            fn () => WalletHelper::processDebit($request->wallet, $amount, $service, $reference, $narration, group: $request->terminal->group),
            fn() => $dataService->purchaseData($phone, $request->code, $amount, $network, $reference, $request->paymentData)
        );
    }
}
