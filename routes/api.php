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
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AppUpdate;
use App\Http\Controllers\TerminalMonitoring;
use App\Service\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

//Route::get('/hash',function(){
//    $hashed = Hash::make('123456789');
//    echo $hashed;
//});
//Route::prefix('v1')->middleware('decode')->group(function () {
Route::prefix('v1')->group(function () {
    Route::post('vfd-impact-callback', \App\Http\Controllers\VfdWebhook::class);

    Route::get('test',             fn() =>  providerCharges(20, 100, 'IBEDC'));

    Route::post('release-fund', function (Request $request) {

        // // $userId = Auth::user()->id;
        // // $accountNumber = VirtualAccount::where('user_id', $userId)->value('account_no');

        // // $accountNumber = "1001651786";
        // if ($accountNumber == "") {
        //     return MyResponse::failed('No account number associated with this user.');
        // }

        $validatedData = $request->validate([
            'amount' => 'required|numeric|min:1',
            'reference' => 'required|min:1',
            'accountNumber' => 'required|digits:10'
        ]);

        // $validatedData['accountNumber'] = $accountNumber;
        $validatedData['walletId'] = "159795503";

        //test "141557338"
        // Log::info('Fund release request received:', array_merge($validatedData, ['userId' => $userId]));

        Log::info('Fund release request received:', $validatedData);

        $result = TransactionService::releaseFund($validatedData['walletId'],  $validatedData['reference'],  $validatedData['accountNumber'], $validatedData['amount']);

        if ($result->responseCode == "00") {
            return MyResponse::success('Fund released successfully', $result);
        } else {
            $errorMessage = $result->message ?? 'Unable to release fund. Please try again.';
            return MyResponse::failed($errorMessage, null, 400);
        }
    });


    Route::post('release-account', function (Request $request) {
        $validator = Validator::make($request->all(), [
            'accountNo' => 'required|digits:10',
            'walletId' => 'required|string',
            'bvn' => 'required|digits:11',
        ]);

        if ($validator->fails()) {
            return MyResponse::failed('Validation error', $validator->errors());
        }

        $data = $validator->validated();

        Log::info('Sending Release Account request', $data);

        try {
            $response = Http::withHeaders([
                'Authorization' => config('providers.spout.hashed_key'),
                'Token' => config('providers.spout.token'),
            ])->post("http://139.162.209.150:5010/api/v1/b2b/release/account", $data);

            if ($response->successful()) {
                Log::info('Release Account API success:', ['response' => $response->json()]);
                return MyResponse::success('Release account successful', $response->json());
            } else {
                Log::error('Release Account API failed:', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
                return MyResponse::failed('Release account failed', $response->json());
            }
        } catch (\Throwable $e) {
            Log::error('Exception during release account:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return MyResponse::failed('Unexpected error occurred while releasing account');
        }
    });

    Route::post('register',             Register::class);
    Route::post('auth',                 Authenticate::class);
    Route::post('forgot-password',      PasswordResetLink::class);
    Route::get('kyc-docs/{user_id}',                [KycDocs::class, 'fetchImage']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('dashboard', Dashboard::class);

        Route::apiResource('terminals',                 Terminals::class)->only('update');
        Route::apiResource('profile',                   Profile::class)->only(['index', 'store']);
        Route::apiResource('services',                  Services::class)->only('index');
        Route::apiResource('kyc-docs',                  KycDocs::class)->only('store', 'destroy');
        //   Route::get('kyc-docs/{user_id}',                [KycDocs::class, 'fetchImage']);
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

        Route::prefix('app-update')->group(function () {
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


Route::prefix('v2')->group(function () {

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/terminal-monitoring', [TerminalMonitoring::class, 'healthData']);
    });
});
