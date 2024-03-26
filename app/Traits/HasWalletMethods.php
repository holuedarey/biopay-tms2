<?php

namespace App\Traits;

use App\Enums\Action;
use App\Exceptions\FailedApiResponse;
use App\Helpers\General;
use App\Models\Service;
use Illuminate\Support\Facades\DB;

trait HasWalletMethods
{
    /**
     * Check if the wallet is allowed to perform the transaction.
     *
     * @param float $amount
     * @param string $action <i>CREDIT</i> or <i>DEBIT</i>
     * @param bool $allow_negative
     * @return bool
     * @throws FailedApiResponse
     */
    public function canPerformTransaction(float $amount, string $action, bool $allow_negative = false): bool
    {
        if ($this->status != 'ACTIVE') throw new FailedApiResponse("Your Wallet is currently $this->status!");

        if ($this->disable_debit) throw new FailedApiResponse('Fund transfer failed!');

        if (strtolower($action) == 'debit' && $amount > $this->balance && !$allow_negative)
            throw new FailedApiResponse("Insufficient balance!");

        return true;
    }

    /**
     * Debit the wallet.
     *
     * @param float $amount The amount to be credited to wallet.
     * @param Service $service The service for which this action occurs
     * @param string $type <code>TRANSACTION || CHARGE</code>
     * @param string|null $reference The transaction reference
     * @param string|null $info Reason for the credit
     * @param float|null $glAmount
     * @return void
     */
    public function debit(float $amount, Service $service, string $type, ?string $reference = null, ?string $info = null, ?float $glAmount = null): void
    {
        DB::transaction(function () use ($amount, $service, $reference, $info, $type, $glAmount) {
            $prev_bal = $this->balance;

            $this->update(['balance' => $prev_bal - $amount]);

            $this->transactions()->create([
                'amount' => $amount,
                'action' => 'DEBIT',
                'reference' => $reference ?? self::newReference(substr($type, 0, 3)),
                'prev_balance' => $prev_bal,
                'new_balance' => $this->balance,
                'info' => $info,
                'type' => $type,
                'product_id' => $service->id,
            ]);

            $service->generalLedger->recordTransaction(Action::CREDIT, $this->user_id, $glAmount ?? $amount, $info);
        });
    }

    /**
     * Credit the wallet.
     *
     * @param float $amount The amount to be credited to wallet.
     * @param Service $service The service for which this action occurs
     * @param string|null $reference The transaction reference
     * @param string|null $info Reason for the credit
     * @param string $type <code>TRANSACTION || COMMISSION</code>
     * @return void
     */
    public function credit(float $amount, Service $service, string|null $reference = null, string|null $info = null, string $type = 'TRANSACTION'): void
    {
        DB::transaction(function () use ($amount, $service, $reference, $info, $type) {
            $prev_bal = $this->balance;

            $this->update(['balance' => $prev_bal + $amount]);

            $this->transactions()->create([
                'amount' => $amount,
                'action' => 'CREDIT',
                'reference' => $reference ?? self::newReference(substr($type, 0, 3)),
                'prev_balance' => $prev_bal,
                'new_balance' => $this->balance,
                'info' => $info,
                'product_id' => $service->id,
                'type' => $type
            ]);

            if ($type != 'COMMISSION') {
                $service->generalLedger->recordTransaction(Action::DEBIT, $this->user_id, $amount, $info);
            }
        });
    }

    public static function newReference(string $prefix): string
    {
        return General::generateReference('wallet', 12, $prefix);
    }
}
