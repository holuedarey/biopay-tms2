<?php

namespace App\Contracts;

use App\Exceptions\FailedApiResponse;
use App\Helpers\Result;
use Illuminate\Support\Collection;

interface CableTvServiceInterface extends BaseService
{
    /**
     * Get plans for available for the decoder type.
     *
     * @param string $decoder The decoder type like <b>dstv</b>, <b>gotv</b>, etc...
     * @return Collection A collection of bouquet plans containing the <b>code</b>, <b>name</b>, <b>id</b>, <b>price</b> and <b>months</b>.
     * @throws FailedApiResponse
     */
    public function getBouquetPlans(string $decoder): Collection;

    /**
     *
     * @param string $decoder The decoder type like <b>dstv</b>, <b>gotv</b>, etc...
     * @param string $uniqueId The decoder id or number.
     * @param string|null $type The subscription type if needed.
     * @return Collection // The response from the validation which holds the <b>name</b> and a <b>paymentData</b>
     * which contains fields required for purchase of the plan.
     *
     * @throws FailedApiResponse
     *
     */
    public function validatePlan(string $decoder, string $uniqueId, string $type = null): Collection;

    /**
     * @param string $decoder The decoder type like <b>dstv</b>, <b>gotv</b>, etc...
     * @param string $planCode The code for the bouquet plan to be purchased
     * @param string $phone The phone number of the recipient
     * @param float $amount The amount of the cable plan
     * @param string $ref The reference of the transaction
     * @param int $months The months of the subscription
     * @param array $paymentData Extra payment data from previous validation that would be required for the purchase.
     * @return Result
     */
    public function purchasePlan(string $decoder, string $planCode, string $phone, float $amount, string $ref, int $months = 1, array $paymentData = []): Result;
}
