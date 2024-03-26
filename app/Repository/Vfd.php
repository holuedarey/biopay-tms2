<?php

namespace App\Repository;

use App\Contracts\VirtualAccountInterface;
use App\Models\User;
use App\Models\VirtualAccount;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use PHPUnit\Framework\ExpectationFailedException;

class Vfd implements VirtualAccountInterface
{

    public string $state;

    public function __construct()
    {
        $this->state = App::isProduction() ? 'live' : 'test';
    }

    public static function url(string $baseEndpoint): string
    {
        $url = App::isProduction() ? config('providers.vfd.url.live') : config('providers.vfd.url.test');

        return str($url)->append($baseEndpoint)->value();
    }

    public function getToken()
    {
        $res = Http::withHeaders([
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Authorization' => 'Basic ' . config("providers.vfd.credential.$this->state")
        ])->post(self::url('/v-token/v1/oauth2/token?grant_type=client_credentials'));

        $data = $res->json();

        return $data['access_token'];
    }

    /**
     * @inheritDoc
     */
    public function createVirtualAccount(User $user): VirtualAccount
    {
        $res = Http::vfd()->withToken($this->getToken())
            ->post("client/individual?{$this->queryParam()}", [
                'firstname' => $user->first_name,
                'lastname' => str($user->other_names)->before(' ')->value(),
                'dob' => Carbon::parse($user->dob)->toDateString(),
                'phone' => $user->phone,
                'bvn' => $user->bvn
            ]);

        if ($res->isVfdSuccess()) {
            return VirtualAccount::create([
                'user_id' => $user->id,
                'bank_name' => 'VFD',
                'account_no' => $res->json('data.accountNo'),
                'provider' => 'VFD',
                'meta' => $res->json()
            ]);
        }

        Log::error('VFD: Virtual Account Creation Failed', [
            'response' => $res->json(),
            'user' => $user->only(['id', 'first_name', 'other_names', 'email'])
        ]);

        throw new ExpectationFailedException($res['message']);
    }

    private function queryParam(): string
    {
        return "wallet-credentials=" . config("providers.vfd.credential.$this->state");
    }
}
