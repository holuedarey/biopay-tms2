<?php

namespace App\Repository;

use App\Exceptions\FailedApiResponse;
use App\Helpers\Result;
use App\Contracts\AirtimeServiceInterface;
use App\Contracts\ElectricityServiceInterface;
use App\Contracts\DataServiceInterface;
use App\Contracts\CableTvServiceInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;

class Vtpass implements
    AirtimeServiceInterface,
    ElectricityServiceInterface,
    DataServiceInterface,
    CableTvServiceInterface
{
    /**
     * @inheritDoc
     */
    public static function name(): string
    {
        return 'VTPASS';
    }

    /**
     * @inheritDoc
     */
    public function purchaseAirtime(float $amount, string $phone, string $ref, string $service): Result
    {
        $response = Http::vtpass()->withheaders([
            'secret-key' => $this->secKey()
        ])->post('pay', [
            "request_id" => date("YmdHi"),
            "serviceID" => $service == '9mobile' ? 'etisalat' : $service,
            "amount" => $amount,
            "phone" =>  $phone,
        ]);

        if ($response['code'] === '000') {
            return new Result(true, $response->collect(), 'Airtime purchase successful');
        }

        return  new Result(false, $response->collect(), $response->vtpassError('Airtime purchase failed.'));
    }

    public function getBouquetPlans(string $decoder): Collection
    {
        $response = Http::vtpass()->withheaders([
            'public-key' =>  $this->pubKey()
        ])->get('service-variations?serviceID='. $decoder);

        if ($response['response_description'] === '000') {
            return $response->collect('content.varations')->map(function ($plan) {
                return [
                    'code' => $plan['variation_code'],
                    'name' => $plan['name'],
                    'price' => $plan['variation_amount'],
                    'id' => $plan['variation_code'],
                    'months' => ''
                ];
            });
        }

        throw new FailedApiResponse($response->spoutError('Failed!'), 200);
    }

    public function validatePlan(string $decoder, string $uniqueId, string $type = null): Collection
    {
        $response =  Http::vtpass()->withHeaders([
            'secret-key' => $this->secKey()
        ])->post("merchant-verify", [
            'billersCode' => $uniqueId,
            'serviceID' => $decoder
        ]);

        if ($response['code'] === '000') {
            return collect([
                'name' => $response['content']['Customer_Name'],
                'paymentData' => ['billersCode' => $uniqueId],
            ]);
        }

        throw new FailedApiResponse($response->vtpassError('Validation failed!'), 404);
    }

    public function purchasePlan(string $decoder, string $planCode, string $phone, float $amount, string $ref, int $months = 1, array $paymentData = []): Result
    {

        $response = Http::vtpass()->withheaders([
            'secret-key' => $this->secKey()
        ])->post('pay', [
            "request_id" => date("YmdHi"),
            "serviceID" => $decoder,
            "amount" => $amount,
            "phone" => $phone,
            "billersCode" => $paymentData['billersCode'],
            "variation_code" => $planCode,
            "subscription_type" => 'change'
        ]);


        if ($response['code'] === '000') {
            return new Result(true, $response->collect(), 'Cable-TV Plan purchase successful');
        }

        return  new Result(false, $response->collect(), $response->vtpassError('Cable-TV Plan purchase failed.'));
    }

    public function getDataPlans(string $network): Collection
    {
        $response = Http::vtpass()->withheaders([
            'public-key' =>  $this->pubKey()
        ])->get('service-variations?serviceID='. $this->network($network));

        if ($response['response_description'] === '000') {

            return collect([
                'plans' => $response->collect('content.varations')->map(fn($item) => [
                    'name' => $item['name'],
                    'code' => $item['variation_code'],
                    'amount' => $item['variation_amount'],
                    'validity' => str($item['name'])->after('- ')->value()
                ])
            ]);
        }

        throw new FailedApiResponse($response->vtpassError('Failed!'), 200);
    }

    public function purchaseData(string $phone, string $code, float $amount, string $network, string $ref, $meta): Result
    {

       $response = Http::vtpass()->withHeaders([
        'secret-key' => $this->secKey()
        ])->post('pay', [
           "request_id" =>  date("YmdHi"),
            "serviceID" => $this->network($network),
            "billersCode" =>  $phone,
            "variation_code" => $code,
            "phone" => $phone,
       ]);

        if($response['code'] == '000') {
            return new Result(true, $response->collect(), 'Data purchase successful');
        }

        return  new Result(false, $response->collect(), $response->vtpassError('Data purchase failed.'));
    }

    public function distributors(): Collection
    {
        return collect(['ikeja', 'eko', 'kano', 'portharcourt', 'jos', 'ibadan', 'kaduna', 'abuja', 'enugu', 'benin'])
            ->sort()->map(fn($value) => [
                'name' => strtoupper($value. ' electricity'),
                'code' => $value. '-electric'
            ]);
    }

    public function validateMeter(string $meter, string $code, string $type, float $amount): Collection
    {
        $response = Http::vtpass()->withHeaders([
            'secret-key' => $this->secKey()
        ])->post('merchant-verify', [
            'billersCode' => $meter,
            'type' => $type,
            'serviceID' => $code,
        ]);

        if ($response['code'] == '000') {
            return collect([
                'name' => $response['content']['Customer_Name'],
                'address' => $response['content']['Address'],
                'paymentData' => [
                    'code' => $code,
                    'type' => $type,
                    'meter' => $meter
                ]
            ]);
        }

        throw new FailedApiResponse($response->vtpassError('Meter validation failed!'));
    }

    public function purchaseEleco(float $amount, string $phone, string $ref, array $paymentData = []): Result
    {
        $response = Http::vtpass()->withHeaders([
            'secret-key' => $this->secKey()
        ])->post('pay', [
            "request_id" =>  date("YmdHi"),
            "serviceID" => $paymentData['code'],
            "billersCode" => $paymentData['meter'],
            "variation_code" => $paymentData['type'],
                "phone" =>  $phone,
            "amount" => $amount
        ]);

        if($response['code'] == '000') {
            return new Result(true, $response->collect(), 'Electricity purchase successful');
        }

        return  new Result(false, $response->collect(), $response->vtpassError('Electricity purchase failed.'));
    }

    public static function header(): array
    {
        return [
            "Accept" => "application/json",
            "Content-Type" => "application/json",
            "api-key" => App::isProduction() ? config('providers.vtpass.keys.live.api_key') : config('providers.vtpass.keys.test.api_key'),
        ];
    }

    private function secKey()
    {
        return App::isProduction() ? config('providers.vtpass.keys.live.secret_key') : config('providers.vtpass.keys.test.secret_key');
    }

    private function pubKey()
    {
        return App::isProduction() ? config('providers.vtpass.keys.live.public_key') : config('providers.vtpass.keys.test.public_key');
    }

    public static function url()
    {
        return App::isProduction() ? config('providers.vtpass.url.live') :  config('providers.vtpass.url.test');
    }

    private function network($value): string
    {
        return match ($value) {
            'mtn' => 'mtn-data',
            'airtel' => 'airtel-data',
            'glo' => 'glo-data',
            '9mobile' => 'etisalat-data',
        };
    }
}
