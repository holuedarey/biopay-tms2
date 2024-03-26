<?php

namespace App\Repository;

use App\Contracts\TransferServiceInterface;
use App\Contracts\VirtualAccountInterface;
use App\Helpers\Result;
use App\Models\Bank;
use App\Models\User;
use App\Models\VirtualAccount;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use PHPUnit\Framework\ExpectationFailedException;

class Paygate implements VirtualAccountInterface, TransferServiceInterface
{
    public string $request_ref;

    private string $sec_key;

    public function __construct()
    {
        $this->sec_key = config('providers.paygate.sec-key');
        $this->request_ref = rand(100000000000000, 999999999999999);
    }

    public static function name(): string
    {
        return 'PAYGATE';
    }

    public function createVirtualAccount(User $user): VirtualAccount
    {
        $res = Http::paygate()->withHeaders([
            'Signature' => $this->signature()
        ])->post('transact', [ // Request payload
            'request_ref' => $this->request_ref,
            'request_type' => 'open_account',
            'auth' => [
                'type' => null,
                'secure' => null,
                'auth_provider' => 'FidelityVirtual',
                'route_mode' => null,
            ],
            'transaction' => $this->transactionPayload($user, "Create account for $user->email", $user->wallet->account_number, details: [
                'name_on_account' => $user->name,
                'middlename' => null,
                'dob' => $user->dob?->toDateString(),
                'gender' => $user->gender[0],
                'title' => null,
                'address_line_1' => $user->address,
                'address_line_2' => null,
                'city' => '',
                'state' => $user->state,
                'country' => 'Nigeria'
            ])
        ]);

        // Check for successful response
        if ($res->isPaygateSuccess()) {
            $data = $res->json('data.provider_response');

            $this->log('info', "New Account Created", [
                'user' => $user->only(['id', 'first_name', 'other_names', 'email']),
                'data' => $data
            ]);

            // Create virtual account if response is successful.
            return VirtualAccount::create([
                'user_id' => $user->id,
                'bank_name' => $data['bank_name'],
                'account_number' => $data['account_number'],
                'unique_id' => $data['reference'],
                'meta' => $data,
                'provider' => self::name()
            ]);
        }

        // Failed response
        $this->log('error', $msg = 'Virtual Account Creation Failed', [
            'response' => $res->json(),
            'user' => $user->only(['id', 'first_name', 'other_names', 'email'])
        ]);

        throw new ExpectationFailedException(self::name() . ": $msg | {$res->json('data.error.message')}");
    }

    public function updateBankList(): Result
    {
        $content = File::json(app_path('Repository/paygate_banks.json'));

        if (!empty($content['banks'])) {
            Bank::whereProvider(self::name())->delete();

            $banks = collect($content['banks'])->map(fn($item) => [
                'name' => $item['bank_name'],
                'code' => $item['bank_cbn_code'],
                'provider' => self::name(),
                'created_at' => now()->toDateTimeString()
            ])->toArray();

            Bank::insert($banks);

            return new Result(true, message: 'Paygate banks updated');
        }

        return new Result(true, message: 'Banks unavailable...');
    }

    public function validateAccount(string $code, string $accountNumber): Result
    {
        $res = Http::paygate()->withHeaders([
            'Signature' => $this->signature()
        ])->post('transact', [ // Request payload
            'request_ref' => $this->request_ref,
            'request_type' => 'lookup_account_min',
            'auth' => [
                'type' => 'bank.account',
                'secure' => $this->encryptV2("$accountNumber;$code"),
                'auth_provider' => 'Fidelity',
                'route_mode' => null,
            ],
            'transaction' => $this->transactionPayload(auth()->user(), 'Validate bank account for transfer')
        ]);

        if ($res->isPaygateSuccess()) {
            return new Result(true, [
                'account_name' => $res->json('data.provider_response.account_name'),
                'paymentData' => []
            ]);
        }

        return new Result(false, message: $res->paygateError('Account validation failed.'));
    }

    public function transfer(string $code, string $accountNumber, float $amount, string $reference, string $narration, string $bank = null, string $accountName = null): Result
    {
        $res = Http::paygate()->withHeaders([
            'Signature' => $this->signature()
        ])->post('transact', [ // Request payload
            'request_ref' => $this->request_ref,
            'request_type' => 'lookup_account_min',
            'auth' => [
                'type' => null,
                'secure' => null,
                'auth_provider' => 'Fidelity',
                'route_mode' => null,
            ],
            'transaction' => $this->transactionPayload(auth()->user(), 'Make transfer', $reference, ($amount * 100), [
                "destination_account" =>  $accountNumber,
                "destination_bank_code" =>  $code
            ])
        ]);

        if ($res->isPaygateSuccess()) {
            return new Result(true, $res->json('data.provider_response'));
        }

        return new Result(false, $res->collect(), $res->paygateError('Transfer failed.'));
    }


    /**
     * This provides the content of the <b>transaction</b> key
     * in the payload to be sent for every request.
     *
     * @param User $user
     * @param string $info
     * @param string|null $ref Unique transaction reference
     * @param float $amount
     * @param array|null $details Extra details that would be added to the request payload.
     * @return array
     */
    protected function transactionPayload(User $user, string $info, string $ref = null, float $amount = 0, array $details = null): array
    {
        $payload = [
//            'mock_mode' => App::isProduction() ? 'Live' : 'Inspect',
            'mock_mode' => 'Inspect', // Todo: Use the one above.
            'transaction_ref' => $ref ?? $this->request_ref,
            'transaction_desc' => $info,
            'transaction_ref_parent' => null,
            'amount' => $amount,
            'customer' => [
                'customer_ref' => $user->wallet->account_number,
                'firstname' => $user->first_name,
                'surname' => $user->other_names,
                'email' => $user->email,
                'mobile_no' => $user->phone
            ],
            'meta' => [
                'uid' => $user->id,
                'wid' => $user->wallet->id
            ]
        ];

        if (!is_null($details)) $payload['details'] = $details;

        return $payload;
    }

    public function log(string $type, string $message, array $data): void
    {
        Log::channel('virtual-account')->{$type}(self::name() . ": $message", $data);
    }

    public function signature(): string
    {
        return md5($this->request_ref . ';' . $this->sec_key);
    }

    public function encryptV2($data): string
    {
        $method = "des-ede3-cbc";
        $source = mb_convert_encoding($this->sec_key, 'UTF-16LE', 'UTF-8');
        $encryption_key = md5($source, true);
        $encryption_key .= substr($encryption_key, 0, 16);
        $iv =  "\0\0\0\0\0\0\0\0";
        $encData = openssl_encrypt($data, $method, $encryption_key, $options = OPENSSL_RAW_DATA, $iv);

        return base64_encode($encData);
    }
}