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
     * @return object{responseCode: string, message: string, data?: mixed}
     * @throws ValidationException
     */
    // public static function releaseFund($walletId, $reference, $accountNumber, $amount)
    // {
    //     $url = self::url("/b2b/release/fund");

    //     try {
    //         $response = Http::withHeaders([
    //             'Authorization' => config('providers.spout.hashed_key'),
    //             'Token' => config('providers.spout.token'),
    //         ])->post($url, [
    //             'walletId' => $walletId,
    //             'reference' => $reference,
    //             'account_number' => $accountNumber,
    //             'amount' => $amount
    //         ]);

    //         if ($response->successful() && $response->json('status') === 'success') {
    //             Log::info('Fund release successful:', $response->json());
    //             return $response;
    //         } else {
    //             throw ValidationException::withMessages(['walletId' => 'Failed to release fund for the specified wallet and pending impact ID.']);
    //         }
    //     } catch (\Exception $e) {
    //         Log::error('Fund release request failed:', ['error' => $e->getMessage()]);
    //         return null;
    //     }
    // }

    /**
     * Release funds for a given wallet ID and pending impact ID.
     *
     * @param string $walletId
     * @param string $reference Transaction reference
     * @param string $accountNumber Destination account
     * @param float $amount Amount to release
     * 
     * @return object{responseCode: string, message: string, data?: mixed} Always returns object with standard structure
     * @throws ValidationException When business validation fails
     */
    public static function releaseFund(
        string $walletId,
        string $reference,
        string $accountNumber,
        string $amount
    ): object {
        $url = self::url("/b2b/release/fund");

        try {
            $response = Http::withHeaders([
                'Authorization' => config('providers.spout.hashed_key'),
                'Token' => config('providers.spout.token'),
            ])
                ->timeout(15)
                ->post($url, [
                    'walletId' => $walletId,
                    'reference' => $reference,
                    'account_number' => $accountNumber,
                    'amount' => $amount
                ]);

            if ($response->failed()) {
                throw new \RuntimeException("API request failed with status: {$response->status()}");
            }

            $responseData = $response->json();

            // Validate and standardize response
            if ($responseData['responseCode'] !== '00') {
                Log::error('Fund release failed', [
                    'error' => $responseData['message'] ?? 'Unknown error',
                    'reference' => $reference
                ]);

                return (object)[
                    'responseCode' => '99',
                    'message' => $responseData['message'] ?? 'Fund release failed',
                    'data' => null
                ];
            }

            // Successful response
            return (object)[
                'responseCode' => '00',
                'message' => $responseData['message'] ?? 'Funds released successfully',
                'data' => $responseData['data'] ?? null
            ];
        } catch (ValidationException $e) {
            // Re-throw business validation exceptions
            throw $e;
        }
    }
}
