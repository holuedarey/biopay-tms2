<?php

// Declare functions that would be used globally throughout the application.
use App\Enums\Action;
use App\Enums\Status;
use App\Models\Service;

function providerChargesData()
{
    return
        [
            [ 'IBEDC' => '0.16'],
            ['MTN' => '0.78'],
            ['GLO' => '1.24'],
            ['AIRTEL' => '0.80'],
            ['9MOBILE' => '1.09'],
            ['AEDC' => '0.49'],
            ['EEDC' => '0.54'],
            ['EKEDC' => '0.34'],
            ['KEDCO' => '0.38'],
            ['PHEDC' => '0.54'],
            ['DSTV' => '0.63'],
            ['GOTV' => '0.63'],
            ['STARTIME' =>'0.53'],
            ['TRANSFER' => '10'],
        ];
}
function searchSubArray(Array $array, $key) {
    foreach ($array as $subarray){
        if (isset($subarray[$key]))
            return $subarray;
    }
}

function getAccountType($type)
{
    if(is_null($type)){
        return null;
    }

    return searchSubArray(providerChargesData(), $type);
}
/**
 * get the color value for a given status.
 * @param string|Status|Action $value
 * @return string
 */
function statusColor(string|Status|Action $value): string
{
    return match ($value) {
        Status::PENDING, 'SUSPENDED', 'CHARGE' => 'warning',

        Status::CONFIRMED, Status::APPROVED, Status::SUCCESSFUL,
        Action::CREDIT, 'FUNDED', 'CREDITED', 'SUCCESS', 'ACTIVE', 'COMMISSION' => 'success',

        Status::DECLINED, Status::FAILED, Action::DEBIT, 'DEBITED', 'INACTIVE', 'DISABLED' => 'danger',

        default  => 'info',
    };
}


/**
 * Convert to human-readable format with country's currency
 *
 * @param float|null $value
 * @param string $symbol
 * @return string
 */
function moneyFormat(float|null $value, string $symbol = '₦'): string
{
    $value ??= 0;

    return str(number_format ($value, 2, ))->whenContains('-',
        fn($value) => $value->replace('-', "- $symbol"),
        fn($value) => $value->prepend($symbol),
    );
}

function providerCharges(float|null $charges, float|null $value, string $service)
{
    //get service charges
    $serviceCharge = getAccountType($service);
    if(!empty($serviceCharge) && $charges != 0)
        return ($charges - ($value * $serviceCharge["{$service}"]));
    return 0;
}


/**
 * Get the app logo from the env
 * @return object
 */
function appLogo(): object
{
    return Cache::rememberForever('app_logo', function () {
        if ($val = config('app.logo')) {
            return (object) ['image' => true, 'value' => $val];
        } else {
            return (object) ['image' => false, 'value' => getenv('APP_NAME')];
        }
    });
}

/**
 * Get the app logo from the env
 * @return object
 */
function appLogo2(): object
{
    return Cache::rememberForever('app_logo_2', function () {
        $val = config('app.logo2');

        return $val ? (object) ['image' => true, 'value' => $val] : appLogo();
    });
}
