<?php

namespace App\Helpers;

use App\Enums\Status;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;

class Purchase
{
    /**
     * Process the transaction by debiting the wallet and making purchase of the service from the provider.
     * <p>Then update the transaction status based on both outcomes.
     *
     * @param Transaction $transaction The created transaction.
     * @param Wallet $wallet The impacted wallet.
     * @param \Closure $debitCallable The wallet debit processing function.
     * @param \Closure $purchaseCallable The service purchase function from the provider
     * @return JsonResponse The <b>MyResponse</b> class
     */
    public static function process(Transaction $transaction, Wallet $wallet, \Closure $debitCallable, \Closure $purchaseCallable): JsonResponse
    {
        $debit = $debitCallable();

        if ($debit->success) {
            // Update transaction
            $transaction->update(['wallet_debited' => true]);

            // Process transfer
            try {
                $purchase = $purchaseCallable();
            }
            catch (\Exception $e) {
                Log::error("Failed Purchase: " . $e->getMessage());
                $purchase = new Result(false, message:  $e->getMessage());
            }

            if ( $purchase->success ) {
                $transaction->update([
                    'status' => Status::SUCCESSFUL,
                    'meta' => $purchase->data
                ]);

                // Credit the superagent if there's a commission after debit
                if ($debit->data['commission']['for_super_agent'] > 0 ) {
                    $wallet->agent->superAgent->wallet->credit(
                        $debit->data['commission']['for_super_agent'],
                        $transaction->service,
                        type: 'COMMISSION'
                    );
                }

                // Credit the superagent if there's a commission after debit
                if ($debit->data['commission']['for_agent'] > 0 ) {
                    $wallet->credit(
                        $debit->data['commission']['for_agent'],
                        $transaction->service,
                        type: 'COMMISSION'
                    );
                }

                return MyResponse::success("SUCCESSFUL: $transaction->info", new TransactionResource($transaction));
            }
        }

        $transaction->update([
            'status' => Status::FAILED,
            'meta' => isset($purchase) ? $purchase->data : null
        ]);

        // Reverse failed purchase if wallet was debited.
        if ($debit->success) $wallet->credit($transaction->amount, $transaction->service, info: "REVERSAL:: $transaction->info");

        // Clear rate limiter for failed request.
        RateLimiter::clear(request()->request->get('throttle-key'));

        return MyResponse::failed(
            $purchase->message ?? $debit->message,
            new TransactionResource($transaction),
            code: $debit->success ? 200 : 403
        );
    }
}
