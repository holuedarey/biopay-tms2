<?php

namespace App\Repository;

use http\Header;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;

class ProvidusBanking
{

    public function virtualAccount()
    {
        $response = Http::providus()->post([
            "request_ref" => "{{request-ref}}",
           "request_type" => "open_account",
            "auth" => [
                "type" => null,
                "secure" => null,
                "auth_provider" => "PolarisVirtual",
                "route_mode" => null
            ],
            "transaction" => [
                "mock_mode" => "Live",
                "transaction_ref" => "{{transaction-ref}}",
                "transaction_desc" => "A random transaction",
                "transaction_ref_parent" => null,
                "amount" => 1000,
                "customer" => [
                    "customer_ref" => "2348033000989",
                    "firstname" => "John",
                    "surname" => "Doe",
                    "email" => "john@doe.com",
                    "mobile_no" => "2348033000989"
                ],
                "meta" => [
                    "a_key" => "a_meta_value_1",
                    "b_key" => "a_meta_value_2"
                ],
                "details" => [
                    "name_on_account" => "John J. Doe",
                    "middlename" => "Jane",
                    "dob" => "2005-05-13",
                    "gender" => "M",
                    "title" => "Mr",
                    "address_line_1" => "23, Okon street, Ikeja",
                    "address_line_2" => "Ikeja",
                    "city" => "Mushin",
                    "state" => "Lagos State",
                    "country" => "Nigeria"
                ]
            ]
        ]);
    }

    public static function header(): array
    {
        return [
            "Authorization" => "Bearer <api-key>",
            "Content-Type" => "application/json",
            "Signature" => "Signature"
        ];
    }

    public static function url(): string
    {
        return "https://api.openbanking.vulte.ng";
    }
}
