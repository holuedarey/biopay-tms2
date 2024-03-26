<?php

namespace App\Helpers;

use App\Models\Fee;
use App\Models\KycLevel;
use App\Models\Service;
use App\Models\TerminalGroup;
use App\Models\Transaction;
use App\Models\User;
use App\Models\WalletTransaction;
use Illuminate\Support\Str;

class General
{
    /**
     * @param string $type
     * @param int $length
     * @param string $prefix
     * @return string
     */
    public static function generateReference(string $type = 'transaction', int $length = 16, string $prefix = '' ): string
    {
        start:
        $reference = ($type == 'user') ? Str::random() : $prefix . strtoupper(Str::random($length));

        switch ($type) {
            case 'wallet':
                if (WalletTransaction::whereReference($reference)->exists()) goto start;
                break;

            case 'user':
                if (User::whereReferralCode($reference)->exists()) goto start;
                break;

            default:
                if (Transaction::whereReference($reference)->exists()) goto start;
                break;
        }

        return $reference;
    }

    public static function generateNameLocation(string $name): string
    {
        $nl = substr($name, 0, 21) . '-'. substr(config('app.name'), 0, 11);

        return str_pad($nl, 35, ' ', STR_PAD_RIGHT) . 'LA NG';
    }

    public static function syncLevelRequiredDocuments(): void
    {
        KycLevel::whereName('GOLD')->first()->documents()->sync([1]);
        KycLevel::whereName('DIAMOND')->first()->documents()->sync([2]);
        KycLevel::whereName('MERCHANT')->first()->documents()->sync([3,4]);
    }

    public static function generateDefaultCommissionFees(): void
    {
        TerminalGroup::whereHas('fees',
            fn($query) => $query->where('type', '!=', 'commission')
        )->each(function ($group) {
            Service::each(
                fn($service) => Fee::upsert([
                    'amount'        => 0,
                    'amount_type'   => Fee::PERCENT,
                    'group_id'      => $group->id,
                    'service_id'    => $service->id,
                    'cap'           => 0,
                    'type'          => Fee::COMMISSION,
                    'created_at'    => now()->toDateTimeString(),
                ], [
                    'group_id'      => $group->id,
                    'service_id'    => $service->id,
                ])
            );
        });
    }
}
