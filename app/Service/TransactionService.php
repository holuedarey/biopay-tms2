<?php

namespace App\Service;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class TransactionService
{

    public function __construct()
    {
        $this->state = App::isProduction() ? 'live' : 'test';
    }

    public static function url(string $baseEndpoint): string
    {
        $url = App::isProduction() ? config('providers.virtual.url.live') : config('providers.virtual.url.test');

        return str($url)->append($baseEndpoint)->value();
    }


    /**
     * Fetch pending transactions for a given account number.
     *
     * @param string $accountNumber
     * @return array|null
     * @throws ValidationException
     */
    public static function getPendingTransactions($accountNumber)
    {
        $url = self::url("/b2b/all/pending/inpact");

        try {
            $response = Http::withHeaders([
                'Authorization' => config('providers.spout.hashed_key'),
                'Token' => config('providers.spout.token'),
            ])->post($url, ['account_number' => $accountNumber]);

            if ($response->successful() && $response->json('status') === 'success') {

                Log::info('API response:', $response->json());

                return $response->json('response');
            } else {
                throw ValidationException::withMessages(['accountNumber' => 'Failed to retrieve pending transaction details.']);
            }
        } catch (\Exception $e) {
            Log::error('API request failed:', ['error' => $e->getMessage()]);

            return null;
        }
    }

    /**
     * Release funds for a given wallet ID and pending impact ID.
     *
     * @param string $walletId
     * @param string $pendingImpactId
     * @return array|null
     * @throws ValidationException
     */
    public static function releaseFund($walletId, $pendingImpactId)
    {
        $url = self::url("/b2b/release/fund");

        try {
            $response = Http::withHeaders([
                'Authorization' => config('providers.spout.hashed_key'),
                'Token' => config('providers.spout.token'),
            ])->post($url, [
                'walletId' => $walletId,
                'pending_impact_id' => $pendingImpactId,
            ]);

            if ($response->successful() && $response->json('status') === 'success') {
                Log::info('Fund release successful:', $response->json());
                return $response->json('response');
            } else {
                throw ValidationException::withMessages(['walletId' => 'Failed to release fund for the specified wallet and pending impact ID.']);
            }
        } catch (\Exception $e) {
            Log::error('Fund release request failed:', ['error' => $e->getMessage()]);
            return null;
        }
    }
}
