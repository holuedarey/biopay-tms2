<?php

namespace App\Repository;

use App\Contracts\AirtimeServiceInterface;
use App\Contracts\CableTvServiceInterface;
use App\Contracts\DataServiceInterface;
use App\Contracts\ElectricityServiceInterface;
use App\Contracts\TransferServiceInterface;
use App\Contracts\VirtualAccountInterface;
use App\Enums\Network;
use App\Exceptions\FailedApiResponse;
use App\Helpers\Result;
use App\Models\Bank;
use App\Models\User;
use App\Models\VirtualAccount;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use PHPUnit\Framework\ExpectationFailedException;

class Spout implements
    AirtimeServiceInterface,
    DataServiceInterface,
    CableTvServiceInterface,
    ElectricityServiceInterface,
    TransferServiceInterface
{
    public static function name(): string
    {
        return 'SPOUT';
    }


    public function purchaseAirtime(float $amount, string $phone, string $ref, string $service): Result
    {
        $res = Http::spout()->post('/airtime/purchase', [
            'phoneNumber' => $phone,
            'uniqueId' => $ref,
            'service' => $this->getAirtimeNetwork($service),
            'amount' => $amount,
            'channel' => 'androidpos',
            'pin' => config('providers.spout.pin'),
            'paymentMethod' => 'cash'
        ]);

        //        $res['responseCode'] == '00'
        if (true) {
            return new Result(true, $res->collect(), 'Airtime purchase successful');
        }

        return  new Result(false, $res->collect(), $res->spoutError('Airtime purchase failed.'));
    }

    public function getDataPlans(string $network): Collection
    {
        $res = Http::spout()->post('/data/validation', [
            'service' => $this->network($network),
            'channel' => 'androidpos',
        ]);

        if ($res->isSpoutSuccess()) {
            return collect([
                'paymentData' => $res->collect()->only('transactionId'),
                'plans' => $res->collect('response.data')->map(fn($item) => [
                    'name' => $item['description'],
                    'code' => $item['code'],
                    'amount' => $item['amount'],
                    'validity' => $item['validity'] ?? "",
                ])
            ]);
        }

        throw new FailedApiResponse($res->spoutError('Failed!'), 200);
    }

    public function purchaseData(string $phone, string $code, float $amount, string $network, string $ref, $meta = null): Result
    {
        $res = Http::spout()->post('/data/payment', [
            'phoneNumber' => $phone,
            'transactionId' => $meta['transactionId'],
            'uniqueId' => $ref,
            'service' => $this->network($network),
            'amount' => (string) $amount,
            'code' => $code,
            'pin' => config('providers.spout.pin'),
            'paymentMethod' => 'cash'
        ]);

        if ($res->isSpoutSuccess()) {
            return new Result(true, $res->collect(), 'Data purchase successful');
        }

        return  new Result(false, $res->collect(), $res->spoutError('Data purchase failed.'));
    }

    public function getBouquetPlans(string $decoder): Collection
    {
        $res = Http::spout()->post('/cabletv/bouquets', [
            'decoderType' => $decoder == 'startimes' ? 'default' : $decoder,
            'service' => $this->decoderService($decoder)
        ]);

        if ($res->isSpoutSuccess()) {
            return $res->collect('response')->map(function ($plan) {
                $firstOption = collect($plan['availablePricingOptions'])->sortBy('monthsPaidFor')->first();

                return [
                    'code' => $plan['code'],
                    'name' => $plan['name'],
                    'id' => $firstOption['_id'],
                    'price' => $firstOption['price'],
                    'months' => $firstOption['monthsPaidFor'],
                ];
            });
        }

        throw new FailedApiResponse($res->spoutError('Failed!'), 200);
    }

    public function validatePlan(string $decoder, string $uniqueId, string $type = null): Collection
    {
        $decoder = $decoder == 'startimes' ? 'default' : $decoder;
        $id = $decoder == 'default' ? 'smartCard' : 'iuc';
        $service = $this->decoderService($decoder);

        $res =  Http::spout()->post("/$service/validation", [
            'decoderType' => $decoder,
            $id => $uniqueId,
            'service' => $service,
            'channel' => 'androidpos',
            'type' => 'subscription'
        ]);


        if ($res->isSpoutSuccess()) {
            return collect([
                'name' => $res['response']['name'],
                'paymentData' => $res->collect()->only('transactionId'),
            ]);
        }

        throw new FailedApiResponse($res->spoutError('Validation failed!'), 404);
    }

    public function purchasePlan(string $decoder, string $planCode, string $phone, float $amount, string $ref, int $months = 1, array $paymentData = []): Result
    {
        $service = $this->decoderService($decoder);
        $code = $decoder == 'startimes' ? 'bouquet' : 'bouquetCode';

        // Todo: Test and complete for startimes.

        $res = Http::spout()->post("/$service/payment", [
            'phoneNumber' => $phone,
            'transactionId' => $paymentData['transactionId'],
            'uniqueId' => $ref,
            $code => $planCode,
            'amount' => $amount,
            'type' => 'subscription',
            'months' => (string) $months,
            'paymentMethod' => 'cash',
            'pin' => config('providers.spout.pin'),
        ]);

        if ($res->isSpoutSuccess()) {
            return new Result(true, $res->collect(), 'Cable Tv plan purchase successful');
        }

        return  new Result(false, $res->collect(), $res->spoutError('Cable Tv plan purchase failed.'));
    }

    public function distributors(): Collection
    {
        return collect(['ikedc', 'ekedc', 'eedc', 'ibedc', 'kedco', 'phedc', 'aedc', 'kadec', 'jedc'])
            ->sort()->map(fn($value) => [
                'name' => strtoupper($value),
                'code' => $value
            ]);
    }

    public function validateMeter(string $meter, string $code, string $type, float $amount): Collection
    {
        $res = Http::spout()->post('/electricity/validation', [
            'account' => $meter,
            'accountType' => $type,
            'service' => $code,
            'amount' => $amount,
            'channel' => 'androidpos'
        ]);

        if ($res->isSpoutSuccess()) {
            return $res->collect('response')
                ->merge(['paymentData' => $res->collect()->only('transactionId')])
                ->only(['name', 'address', 'paymentData']);
        }

        throw new FailedApiResponse($res->spoutError('Meter validation failed!'));
    }

    public function purchaseEleco(float $amount, string $phone, string $ref, array $paymentData = []): Result
    {
        $res = Http::spout()->post('/electricity/payment', [
            'phoneNumber' => $phone,
            'transactionId' => $paymentData['transactionId'],
            'uniqueId' => $ref,
            'paymentMethod' => 'cash',
            'pin' => config('providers.spout.pin'),
        ]);

        Log::error($res->collect());
        if ($res->isSpoutSuccess()) {
            return new Result(true, $res->collect(), 'Electricity bill payment successful');
        }

        return new Result(false, $res->collect(), $res->spoutError('Electricity bill payment failed.'));
    }

    public function updateBankList(): Result
    {
        $res = Http::spout()->post('/get-bank-codes', ['service' => 'transfer']);

        if ($res->isSpoutSuccess()) {
            $banks = $res->collect('response.bankCodes');
            if ($banks->isNotEmpty()) {
                Bank::whereProvider(self::name())->delete();

                $banks->each(function ($item) {
                    if (isset($item['bankCode'])) {
                        Bank::create([
                            'name' => $item['bankName'],
                            'code' => $item['bankCode'],
                            'provider' => self::name()
                        ]);
                    }
                });
            }

            return new Result(true, message: 'Spout banks updated');
        }

        Log::error("========SPOUT BANK LIST ERROR========\n ", $res->collect()->toArray());

        return new Result(false, message: 'Failed to update Spout banks');
    }

    public function validateAccount(string $code, string $accountNumber): Result
    {
        $res = Http::spout()->post('transfer/validation', [
            'bankCode' => $code,
            'amount' => request('amount'),
            'accountNo' => $accountNumber,
            'service' => 'transfer',
            'channel' => 'b2b'
        ]);

        if ($res->isSpoutSuccess()) {
            return new Result(true, [
                'account_name' => $res->collect('response')->get('name'),
                'paymentData' => $res->collect()->only('transactionId')
            ]);
        }

        return new Result(false, message: $res->spoutError('Account validation failed.'));
    }

    public function transfer(string $code, string $accountNumber, float $amount, string $narration, string $reference, string $bank = null, string $accountName = null, $transaction = ""): Result
    {
        $res = Http::spout()->post('transfer/payment', [
            'uniqueId' => request('paymentData')['transactionId'] . $transaction,
            'phoneNumber' => request('phone') ?? auth()->user()->phone,
            'transactionId' => request('paymentData')['transactionId'],
            'paymentMethod' => 'cash',
            'pin' => config('providers.spout.pin'),
            'senderName' => str(request('name'))->append(';' . config('app.name') . ';POS'),
            'narration' => $reference,
            'service' => 'transfer',
        ]);

        if ($res->isSpoutSuccess()) {
            return new Result(true, $res->collect('response')->toArray());
        }

        return new Result(false, $res->collect(), $res->spoutError('Transfer failed.'));
    }

    public static function headers(): array
    {
        /*$key_to_hash = config('providers.spout.identifier') . config('providers.spout.key') . config('providers.spout.email');
        $hashed_key = hash('sha256', $key_to_hash);*/

        return [
            'Authorization' => config('providers.spout.hashed_key'),
            'Token' => config('providers.spout.token')
        ];
    }

    public static function url(): string
    {
        return config('providers.spout.url.live');
    }

    private function network($value): string
    {
        return match ($value) {
            'mtn' => 'mtndata',
            'airtel' => 'airteldata',
            'glo' => 'glodata',
            '9mobile' => '9mobiledata',
        };
    }

    private function decoderService(string $decoder): string
    {
        return match ($decoder) {
            'startimes', 'default' => 'startimes',
            'dstv', 'gotv' => 'multichoice',
        };
    }

    private function getAirtimeNetwork(string $value): string
    {
        return match ($value) {
            Network::MTN->value         => 'mtnvtu',
            Network::AIRTEL->value      => 'airtelvtu',
            Network::GLO->value         => 'glovtu',
            Network::ETISALAT->value    => '9mobilevtu',
            default => throw new \Exception('Invalid airtime network value.'),
        };
    }


    public function createVirtualAccount(User $user)
    {

        //        $res = Http::withHeaders(Spout::headers())->post("http://139.162.209.150:5010/api/v1/virtual-account-create", [
        $res = Http::withHeaders(['Authorization' => config('providers.spout.hashed_key'), 'Token' => config('providers.spout.token')])->post("http://139.162.209.150:5010/api/v1/b2b/virtual/account", [
            'firstName' => $user->first_name,
            'lastName' => str($user->other_names)->before(' ')->value(),
            'dateOfBirth' => Carbon::parse($user->dob)->toDateString(),
            'phoneNumber' => $user->phone,
            'bvn' => $user->bvn,
            'walletId' => '159795503',
            'b2bCompanyName' => 'speedfinancial',
            'email' => $user->email
        ]);

        if ($res) {
            $user->consent_url = $res->json('url') ?? "";
            $user->save();


            $responseData = $res->json();

            $accountNumber = data_get($responseData, 'accountDetails.accountNo')
                ?? data_get($responseData, 'data.accountNo') ?? null;

            if (!$accountNumber) {
                // Log the response for debugging if account number isn't found
                logger()->warning('Virtual account number not found in response', [
                    'response' => $responseData,
                    'user_id' => $user->id
                ]);

                throw new \RuntimeException('Failed to extract account number from provider response');
            }


            return VirtualAccount::create([
                'user_id' => $user->id,
                'bank_name' => 'VFD',
                //'account_no' => 'my account',
                'account_number' => $accountNumber,
                'provider' => 'VFD',
                'meta' => $res->json()
            ]);
        }

        Log::error('SPOUT: Virtual Account Creation Failed', [
            'response' => $res->json(),
            'user' => $user->only(['id', 'first_name', 'other_names', 'email'])
        ]);

        //        throw new ExpectationFailedException($res['message']);
    }
}
