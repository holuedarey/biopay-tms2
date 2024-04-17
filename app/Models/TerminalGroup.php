<?php

namespace App\Models;

use Cjmellor\Approval\Concerns\MustBeApproved;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Log;

class TerminalGroup extends Model
{
    use HasFactory, MustBeApproved;

    protected $guarded = ['id'];

    public function fees(): HasMany
    {
        return $this->hasMany(Fee::class, 'group_id');
    }

    public function terminals(): HasMany
    {
        return $this->hasMany(Terminal::class, 'group_id');
    }

    public function charge(Service $service, float $amount): float
    {
        $fee = $this->fees()->whereBelongsTo($service)->whereType(Fee::CHARGE)->first();

        return $fee?->getValue($amount) ?? 0;
    }

    public function commission(Service $service, float $amount): float
    {
        $fee = $this->fees()->whereBelongsTo($service)->whereType(Fee::COMMISSION)->first();

        return $fee?->getValue($amount) ?? 0;
    }

    /**
     * @param Service $service
     * @param float $amount
     * @return array<string,float>
     */
    public function sharedCommission(Service $service, float $amount): array
    {
        $fee = $this->fees()->whereBelongsTo($service)->whereType(Fee::COMMISSION)->first();
        Log::error("commison for mtn". json_encode($fee));
        $commission = $fee?->getValue($amount) ?? 0;
        Log::error("commison nfor mtn " . $commission);

        $amount -= $commission;

        if ($fee->amount_type == $fee::FIXED) {
            return [$fee->structure, $amount];
        } else {
            $c = [];
            $c['for_agent'] = ((float) $fee->agent_commission /100) * $commission;
            $c['for_super_agent'] = ((float) $fee->super_agent_commission /100) * $commission;
            Log::error("commison nfor mtn " . json_encode($c));

            return [$c, $amount];
        }
    }
}
