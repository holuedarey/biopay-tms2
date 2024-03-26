<?php

namespace App\Providers;

use App\Contracts\AirtimeServiceInterface;
use App\Contracts\CableTvServiceInterface;
use App\Contracts\DataServiceInterface;
use App\Contracts\ElectricityServiceInterface;
use App\Contracts\TransferServiceInterface;
use App\Models\Service;
use App\Repository\ProvidusBanking;
use App\Repository\Spout;
use App\Repository\Vfd;
use App\Repository\Vtpass;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class TransactionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->bindCableTvService();
        $this->bindAirtimeService();
        $this->bindInternetDataService();
        $this->bindElectricityService();
        $this->bindBankTransferService();
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->bootHttpMacros();
        $this->bootResponseMacros();
    }

    private function bindCableTvService(): void
    {
        $this->app->bind(CableTvServiceInterface::class,
            fn () => Service::activeProvider('cabletv')
        );
    }

    private function bindAirtimeService(): void
    {
        $this->app->bind(AirtimeServiceInterface::class,
            fn () => Service::activeProvider('airtime')
        );
    }

    private function bindInternetDataService(): void
    {
        $this->app->bind(DataServiceInterface::class,
            fn () => Service::activeProvider('internetdata')
        );
    }

    private function bindElectricityService(): void
    {
        $this->app->bind(ElectricityServiceInterface::class,
            fn () => Service::activeProvider('electricity')
        );
    }

    private function bindBankTransferService(): void
    {
        $this->app->bind(TransferServiceInterface::class,
            fn () => Service::activeProvider('banktransfer')
        );
    }

    private function bootHttpMacros(): void
    {
        Http::macro('spout', fn() => Http::withHeaders(Spout::headers())->baseUrl(Spout::url()));

        Http::macro('vtpass', fn() => Http::withHeaders(Vtpass::header())->baseUrl(Vtpass::url()));

        Http::macro('providus', fn() => Http::withHeaders(ProvidusBanking::header())->baseUrl(ProvidusBanking::url()));

        Http::macro('paygate',
            fn() => Http::withToken(config('providers.paygate.api-key'))
                ->baseUrl(config('providers.paygate.url'))
        );


        Http::macro('vfd', fn() => Http::baseUrl(Vfd::url('/vtech-wallet/api/v1.1/wallet2')));

    }

    private function bootResponseMacros(): void
    {
        Response::macro('isSpoutSuccess', fn() => $this['responseCode'] === '00');

        Response::macro('spoutError', function($msg) {
            Log::error("SPOUT {$this['responseCode']}: {$this['message']} \n", $this->json());

            $errorMsg = $this['responseCode'] === '05' ? $this['message'] : $msg;

            return "$errorMsg... Contact support.";
        });

        Response::macro('vtpassError', function($msg) {
            Log::error("VTPASS {$this['code']}: {$this['response_description']} \n", $this->json());

            $errorMsg = $this['code'] !== '011' ? $this['response_description']: $msg;

            return "$errorMsg... Contact support!.";
        });

        Response::macro('isPaygateSuccess',
            fn() => strtolower($this->json('status')) == 'successful' &&
                $this->json('data.provider_response_code') == '00'
        );

        Response::macro('paygateError', function($msg) {
            Log::error("PAYGATE {$this->json('data.provider_response_code')}: {$this['message']} \n", $this->json());

            return $msg;
        });


        Response::macro('isVfdSuccess',  fn() => $this['status'] === '00');
    }
}
