<?php

namespace App\Contracts;

use App\Helpers\Result;
use Illuminate\Support\Collection;

interface AirtimeServiceInterface extends BaseService
{
    /**
     * Make purchase for airtime.
     *
     * @param float $amount The amount of airtime to be purchased
     * @param string $phone The phone number for the airtime purchase
     * @param string $ref The reference of the transaction
     * @param string $service The network service for the airtime. <b>mtn</b>, <b>glo</b>, <b>airtel</b>, <b>9mobile</b>
     * @return Result
     */
    public function purchaseAirtime(float $amount, string $phone, string $ref, string $service): Result;
}
