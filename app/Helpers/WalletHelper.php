<?php

namespace App\Helpers;

use App\Models\Service;
use App\Models\TerminalGroup;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class WalletHelper
{
    /**
     * Process the debit the wallet transaction.
     *
     * @param Wallet $wallet
     * @param float $amount The amount to be debited from the wallet
     * @param Service $service Service for which debit occurs
     * @param string|null $reference The transaction unique reference
     * @param string|null $info Reason for the debit
     * @param float $charge
     * @param bool $allow_negative
     * @param TerminalGroup|null $group // Needed when commission is to be accounted for.
     * @return Result
     */
    public static function processDebit(
        Wallet $wallet,
        float $amount,
        Service $service,
        string|null $reference,
        string|null $info,
        float $charge = 0,
        TerminalGroup $group = null,
        bool $allow_negative = false,
    ): Result
    {
        try {
            $wallet->canPerformTransaction(($amount + $charge), 'DEBIT', $allow_negative);

            [$commission, $charge, $glAmount] = self::getCommission($service, $wallet, $amount, $charge, $group);

            Log::error("printinhg ". json_encode( [$commission, $charge, $glAmount] ));
            DB::transaction(function () use ($wallet, $amount, $service, $reference, $info, $charge, $glAmount){
                $wallet->debit($amount, $service, 'TRANSACTION', $reference, $info, $glAmount);

                if ($charge > 0) $wallet->debit($charge, $service, 'CHARGE', info: 'Charge for '. strtolower($service->name));
            });

            return new Result(true, ['commission' => $commission]);
        }
        catch (\Exception $e) {
            Log::error("Wallet Debit Error: {$e->getMessage()}");

            return new Result(false, message: $e->getMessage());
        }
    }

    /**
     * Get the commission on the service and the new amount and charge to be debited, where applicable.
     * @param Service $service
     * @param Wallet $wallet
     * @param float $amount
     * @param float $charge
     * @param TerminalGroup|null $group
     * @return array<string,float>
     */
    public static function getCommission(Service $service, Wallet $wallet, float $amount, float $charge, ?TerminalGroup $group): array
    {
        $commission = ['for_super_agent' => 0, 'for_agent' => 0];

        Log::error("has super agent". $wallet->agent->hasSuperAgent());
        if ($wallet->agent->hasSuperAgent()) {
            if ($service->isBankTransfer()) {
                if ($charge > 0 && !is_null($group)) {
                    $commission['for_super_agent'] = $group->commission($service, $charge);
                    $charge -= $commission['for_super_agent'];
                }
            }

            Log::error("bill payment,". $service->isBillPayment());
            Log::error("group". !is_null($group));
            if ($service->isBillPayment() && !is_null($group)) {
                [$commission, $amount] = $group->sharedCommission($service, $amount);
                Log::error("finnaly,". json_encode([$commission, $amount]));
            }
        }

        return [$commission, $charge, $amount];
    }
}
