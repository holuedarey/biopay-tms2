<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\VirtualAccount;
use App\Models\VirtualAccountCredit;
use App\Repository\Paygate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class PaygateWebhook extends Controller
{
    public function __invoke(Request $request, Paygate $paygate)
    {
        $paygate->request_ref = $request->get('request_ref');

        abort_if($request->header('Signature') != $paygate->signature(), 403);

        $data = $request->collect('details');

        // Check for valid request data
        if ( ($request->get('request_type') != 'transaction_notification') || // Ensure correct event
            (App::isProduction() && $request->get('mock_mode') != 'live') || // Ensure only live request for when app is in production
            (strtolower($data['status']) != 'successful') // Only accept successful request
        ) {
            exit('Not applicable.');
        }

        // Ensure the transaction has not been sent before.
        if (VirtualAccountCredit::whereReference($data['transaction_ref'])->exists()) {
            $paygate->log('warning', 'PAYGATE: DUPLICATE VA CREDIT', $data->toArray());
            exit('Duplicate');
        }

        $data->put('paid_at', now()->toDateTimeString());

        $paygate->log('info', 'PAYGATE: NEW VA CREDIT', $data->toArray());

        $va = VirtualAccount::whereUniqueId($data['customer_ref'])->first();

        if (is_null($va)) {
            // Todo: Notify system admin...
        }

        $va->processCredit($data);

        exit('Done');
    }
}
