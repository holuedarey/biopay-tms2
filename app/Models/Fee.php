<?php

namespace App\Models;

use Cjmellor\Approval\Concerns\MustBeApproved;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Fee extends Model
{
    use HasFactory, LogsActivity, MustBeApproved;

    const CHARGE = 'CHARGE';
    const COMMISSION = 'COMMISSION';
    const FIXED = 'FIXED';
    const PERCENT = 'PERCENTAGE';
    const CONFIG = 'CONFIG';

    protected $guarded = ['id'];

    protected $casts = [
        'config'    => 'object',
        'structure' => 'array'
    ];

    public static function amountTypes(): array
    {
        return [self::CONFIG, self::FIXED, self::PERCENT];
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(TerminalGroup::class);
    }

    protected function title(): Attribute
    {
        return Attribute::get(fn() => $this->service->name);
    }

    public function agentCommission(): Attribute
    {
        return Attribute::get(fn() => $this->structure['for_agent'] ?? 0);
    }

    public function superAgentCommission(): Attribute
    {
        return Attribute::get(fn() => $this->structure['for_super_agent'] ?? 0);
    }

    /**
     * Create Default fees for the specified group.
     *
     * @param $groupId
     * @return void
     */
    public static function createDefault($groupId): void
    {
        Service::each(function (Service $service) use ( $groupId ) {

            $config = null;

            if ( $transfer = $service->slug == 'banktransfer' ) {
                $config = json_encode([
                    ['range' => '0-5000', 'amount' => 10.0],
                    ['range' => '5001-50000', 'amount' => 21.51],
                    ['range' => '50001-1000000', 'amount' => 30.0],
                ]);
            }

            if (!in_array($service->slug, [$service::AIRTIME, $service::DATA])) {
                // Charge fees
                Fee::upsert([
                    'amount'        => $transfer ? 0 : 10.00,
                    'config'        => $config,
                    'amount_type'   => $transfer ? self::CONFIG : self::FIXED,
                    'group_id'      => $groupId,
                    'service_id'    => $service->id,
                    'cap'           => $transfer ? 50 : 0,
                    'type'          => self::CHARGE,
                    'created_at'    => now()->toDateTimeString(),
                ], [
                    'group_id'      => $groupId,
                    'service_id'    => $service->id,
                ]);
            }

            // Commission fees
            Fee::upsert([
                'amount'        => 0,
                'amount_type'   => self::PERCENT,
                'group_id'      => $groupId,
                'service_id'    => $service->id,
                'cap'           => 0,
                'type'          => self::COMMISSION,
                'created_at'    => now()->toDateTimeString(),
            ], [
                'group_id'      => $groupId,
                'service_id'    => $service->id,
            ]);
        });
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Fee')
            ->logOnly(['amount', 'type', 'config', 'cap']);
    }

    /**
     * Get the value fee for the specified amount.
     *
     * @param float $amount
     * @return float
     */
    public function getValue(float $amount): float
    {
        $fee = match ($this->amount_type) {
            self::FIXED => $this->amount,
            self::PERCENT => $this->getPercentageValue($amount),
            self::CONFIG => $this->getConfigValue($amount)
        };

        // If fee is greater than or equal to amount, return 0 fee.
        return $fee >= $amount ? 0 : $fee;
    }

    /**
     * Get the percentage fee on the amount.
     *
     * @param float $amount
     * @return float
     */
    public function getPercentageValue(float $amount): float
    {
        $charge = ($this->amount / 100) * $amount;

        return min($charge, $this->cap);
    }

    /**
     * Get the fee based on the configuration.
     *
     * @param float $amount
     * @return float
     */
    public function getConfigValue(float $amount): float
    {
        foreach ($this->config as $config) {
            $min = (float) str($config->range)->before('-')->trim()->value();
            $max = (float) str($config->range)->afterLast('-')->trim()->value();

            if ($amount >= $min && $amount <= $max) return (float) $config->amount;
        }

        return $this->cap;
    }

    public function isCommission(): bool
    {
        return $this->type === self::COMMISSION;
    }
}
