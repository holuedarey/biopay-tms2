<?php

use App\Helpers\MyResponse;
use App\Http\Controllers\Api\AddBvn;
use App\Http\Controllers\Api\AirtimePurchase;
use App\Http\Controllers\Api\Authenticate;
use App\Http\Controllers\Api\Banks;
use App\Http\Controllers\Api\CableTvPurchase;
use App\Http\Controllers\Api\Dashboard;
use App\Http\Controllers\Api\DataPurchase;
use App\Http\Controllers\Api\ElectricityPurchase;
use App\Http\Controllers\Api\KycDocs;
use App\Http\Controllers\Api\Levels;
use App\Http\Controllers\Api\Loans;
use App\Http\Controllers\Api\Logout;
use App\Http\Controllers\Api\PasswordResetLink;
use App\Http\Controllers\Api\PaygateWebhook;
use App\Http\Controllers\Api\Profile;
use App\Http\Controllers\Api\Register;
use App\Http\Controllers\Api\Services;
use App\Http\Controllers\Api\Terminals;
use App\Http\Controllers\Api\Transactions;
use App\Http\Controllers\Api\Transfer;
use App\Http\Controllers\Api\Wallets;
use App\Http\Controllers\Api\WalletTransactions;
use App\Models\Service;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AppUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

//Route::get('/hash',function(){
//    $hashed = Hash::make('123456789');
//    echo $hashed;
//});

Route::prefix('v1')->group(function () {

    Route::get('test',             fn () =>  providerCharges(20, 100, 'IBEDC'));
//    Route::post('release-account',             function(Request $request) {
//        \Illuminate\Support\Facades\Log::error(json_encode($request->all()));
//        $virtual_account  = \App\Models\VirtualAccount::create([
//                'user_id' => $request->userId,
//                'bank_name' => $request->bankName,
//                'account_no' => $request->accountNo,
//                'provider' => 'VFD',
//                'meta' => $request
//            ]);
//        return MyResponse::success('Account Release successfully');
//
//    });

    Route::post('release-account',             function(Request $request) {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'accountNo' => 'required|digits:10|string',
            'walletId' => 'required|string',
            'bvn' => 'required|digits:11|integer'
        ]);

        // If validation fails, return an error response
        if ($validator->fails()) {
            return MyResponse::failed('Validation error', $validator->errors());
        }

        // Log the request data
        Log::error(json_encode($request->all()));

        // Retrieve user details (assuming $user is defined elsewhere)
        $user = auth()->user(); // Example, adjust as per your context

        // Prepare the data for the external API request
        $data = [
            'accountNo' => $request->input('accountNo'),
            'walletId' => $request->input('walletId'),
            'bvn' => $request->input('bvn'),
        ];

        // Send the HTTP POST request to the external API
        $response = Http::withHeaders([
            'Authorization' => config('providers.spout.hashed_key'),
            'Token' => config('providers.spout.token'),
        ])->post("http://139.162.209.150:5010/api/v1/b2b/release/account", $data);

        // Check if the request was successful
        if ($response->successful()) {
            // Log the successful response from the external service
            Log::info('API Response:', ['response' => $response->json()]);

            // Return a success response
            return MyResponse::success('Account released successfully');
        } else {
            // Log the failed response
            Log::error('API Request Failed:', [
                'status' => $response->status(),
                'response' => $response->json()
            ]);

            // Return an error response
            return MyResponse::failed('Account release failed', $response->json());
        }
    });
    Route::post('register',             Register::class);
    Route::post('auth',                 Authenticate::class);
    Route::post('forgot-password',      PasswordResetLink::class);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('dashboard', Dashboard::class);

        Route::apiResource('terminals',                 Terminals::class)->only('update');
        Route::apiResource('profile',                   Profile::class)->only(['index', 'store']);
        Route::apiResource('services',                  Services::class)->only('index');
        Route::apiResource('kyc-docs',                  KycDocs::class)->only('store', 'destroy');
        Route::apiResource('wallets',                   Wallets::class)->only('index');
        Route::apiResource('transactions',              Transactions::class)->only(['index', 'show']);
        Route::apiResource('wallet-transactions',       WalletTransactions::class)->only('index');
        Route::apiResource('banks',                     Banks::class)->only(['index']);
        Route::apiResource('loans',                     Loans::class)->only(['index', 'store', 'destroy']);
        Route::apiResource('levels',                    Levels::class)->only('index');

        Route::apiResource('validate-transfer',         Transfer::class)->only('index');
        Route::apiResource('transfer',                  Transfer::class)->only('store');

        Route::apiResource('airtime-services',          AirtimePurchase::class)->only('index');
        Route::apiResource('airtime-purchase',          AirtimePurchase::class)->only('store');

        Route::apiResource('data-plans',                DataPurchase::class)->only('index');
        Route::apiResource('data-purchase',             DataPurchase::class)->only('store');

        Route::prefix('app-update')->group(function (){
            Route::post('/',                     [AppUpdate::class, 'check']);
            Route::post('/download_count',       [AppUpdate::class, 'update']);
        });

        Route::post('cabletv/plans',             [CableTvPurchase::class, 'plans']);
        Route::post('cabletv/validate',          [CableTvPurchase::class, 'validateAccount']);
        Route::post('cabletv/purchase',          [CableTvPurchase::class, 'purchase']);

        Route::get('electricity/distributors',  [ElectricityPurchase::class, 'distributors']);
        Route::post('electricity/validate-meter',            [ElectricityPurchase::class, 'validateMeter']);
        Route::post('electricity/purchase',      [ElectricityPurchase::class, 'purchase']);

        Route::get('levels/add-bvn',           AddBvn::class);

        Route::get('logout',    Logout::class);
    });
});

Route::post('paygate-webhook', PaygateWebhook::class);
