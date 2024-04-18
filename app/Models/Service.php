<?php

namespace App\Models;

use App\Enums\Status;
use App\Exceptions\FailedApiResponse;
use Cjmellor\Approval\Concerns\MustBeApproved;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * These hold the services for which every transaction occurring on the system is carried out for.
 * <p>They include **bill payments**, **transfers**, **withdrawal**, **funding**, etc.
 */
class Service extends Model
{
    use HasFactory, LogsActivity, MustBeApproved;

    const AIRTIME = 'airtime';
    const MTN = 'mtn';
    const AIRTEL = 'airtel';
    const GLO = 'glo';
    const NINEMOBILE = '9mobile';
    const ETISALAT = 'etisalat';

    const DATA = 'internetdata';
    const CABLETV = 'cabletv';
    const GOTV = 'GOtv';
    const DSTV = 'dstv';
    const ELECTRICITY = 'electricity';
    const BANKTRANSFER = 'banktransfer';
    const CASHOUT = 'cashoutwithdrawal';
    const LOAN = 'loan';
    const WALLETTRANSFER = 'wallettransfer';

    protected $guarded = ['id'];

    protected $casts = [
        'is_available' => 'boolean',
        'menu' => 'boolean'
    ];

    protected $appends = [
        'icon'
    ];

    protected static function boot()
    {

        parent::boot();

        static::creating(fn ($service) => $service->slug = str($service->name)->slug(''));

        static::created(function ($service) {
            \Cache::forget('services');
            if ($service->wasChanged(['menu_name'])) \Cache::forget('default-menus');
        });

        static::updated(function ($service) {
            \Cache::forget('services');
            if ($service->wasChanged(['menu_name'])) \Cache::forget('default-menus');
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected function icon(): Attribute
    {
        return Attribute::get(function () {
            return match ($this->slug) {
                self::BANKTRANSFER => asset('assets/images/services/transfer.webp'),
                self::CASHOUT => asset('assets/images/services/cashout.webp'),
                self::CABLETV => asset('assets/images/services/cabletv.webp'),
                self::LOAN => asset('assets/images/services/loan.webp'),
                self::DATA => asset('assets/images/services/data.webp'),
                self::AIRTIME => asset('assets/images/services/airtime.webp'),
                self::ELECTRICITY => asset('assets/images/services/electricity.webp'),
                default => asset('assets/images/services/topup.webp')
            };
        });
    }

// Relationships

    public function providers(): HasMany
    {
        return $this->hasMany(ServiceProvider::class);
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(ServiceProvider::class, 'provider_id');
    }

    public function walletTransactions(): HasMany
    {
        return $this->hasMany(WalletTransaction::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'type_id');
    }

    public function generalLedger(): HasOne
    {
        return $this->hasOne(GeneralLedger::class);
    }

    public function terminals(): BelongsToMany
    {
        return $this->belongsToMany(Terminal::class)->withTimestamps();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Service')
            ->logOnly(['name', 'description', 'provider']);
    }

    public static function cableTv(): static
    {
        return self::whereSlug(self::CABLETV)->first();
    }

    public static function cableTvService($service): static
    {
        return self::whereSlug($service)->first();
    }
    public static function airtime(): static
    {
        return self::whereSlug(self::AIRTIME)->first();
    }

    public static function airtimeService($service): static
    {
        return self::whereSlug($service)->first();
    }

    public static function internetData(): static
    {
        return self::whereSlug(self::DATA)->first();
    }

    public static function electricity(): static
    {
        return self::whereSlug(self::ELECTRICITY)->first();
    }
    public static function electricityService($service): static
    {
        return self::whereSlug($service)->first();
    }

    public static function bankTransfer(): static
    {
        return self::whereSlug(self::BANKTRANSFER)->first();
    }

    public function scopeWithSearch(Builder $query, $search): Builder
    {
        return $query->where('name', 'like', '%' . $search . '%');
    }

    public function scopeRegular(Builder $query): Builder
    {
        return $query->orderBy('name')->whereNotIn('slug', [self::WALLETTRANSFER]);
    }

    public function scopeTransactionCount(Builder $query, string $period, ?User $user = null): Builder
    {
        // Get the failed and successful transactions for the time period.
        $selected = [
            'transactions as failed' => fn($query) => $query->filterByDateDesc($period)
                ->whereStatus(Status::FAILED)
                ->when($user ?? false)->forUser($user),
            'transactions as successful' => fn($query) => $query->filterByDateDesc($period)
                ->whereStatus(Status::SUCCESSFUL)
                ->when($user ?? false)->forUser($user),
        ];

        // Get the failed and successful transactions for the previous time period.
        switch ($period) {
            case 'today':
                $previous = [
                    'transactions as previous_failed' => fn($query) => $query->filterByDateDesc('yesterday')
                        ->whereStatus(Status::FAILED)
                        ->when($user ?? false)->forUser($user),
                    'transactions as previous_successful' => fn($query) => $query->filterByDateDesc('yesterday')
                        ->whereStatus(Status::SUCCESSFUL)
                        ->when($user ?? false)->forUser($user),
                ];
                break;

            case 'yesterday': $date = [today()->subDays(2)->toDateString()];
                $previous = [
                    'transactions as previous_failed' => fn($query) => $query->filterByDate($date)
                        ->whereStatus(Status::FAILED)
                        ->when($user ?? false)->forUser($user),
                    'transactions as previous_successful' => fn($query) => $query->filterByDate($date)
                        ->whereStatus(Status::SUCCESSFUL)
                        ->when($user ?? false)->forUser($user),
                ];
                break;

            case 'month': $date = today()->subMonth();
                $previous = [
                    'transactions as previous_failed' => fn($query) => $query->whereStatus(Status::FAILED)
                        ->whereMonth(self::CREATED_AT, $date->month)
                        ->whereYear(self::CREATED_AT, $date->year)
                        ->when($user ?? false)->forUser($user),
                    'transactions as previous_successful' => fn($query) => $query->whereStatus(Status::SUCCESSFUL)
                        ->whereMonth(self::CREATED_AT, $date->month)
                        ->whereYear(self::CREATED_AT, $date->year)
                        ->when($user ?? false)->forUser($user),
                ];
                break;

            case 'year': $date = today()->subYear();
                $previous = [
                    'transactions as previous_failed' => fn($query) => $query->whereStatus(Status::FAILED)
                        ->whereYear(self::CREATED_AT, $date->year)
                        ->when($user ?? false)->forUser($user),
                    'transactions as previous_successful' => fn($query) => $query->whereStatus(Status::SUCCESSFUL)
                        ->whereYear(self::CREATED_AT, $date->year)
                        ->when($user ?? false)->forUser($user),
                ];
                break;

            default: $previous = [];
                break;
        }

        return $query->withCount(array_merge($selected, $previous));
    }

    /**
     * Get the class for the active provider of the service.
     *
     * @param string $slug
     * @return mixed
     * @throws \Throwable
     */
    public static function activeProvider(string $slug): mixed
    {
        $service = self::{strtolower($slug)}();

        $name = ucwords(strtolower($service->name));

        throw_if(is_null($service->provider), new FailedApiResponse("$name is currently unavailable.", 404));

        return new $service->provider->class;
    }

    public function isBankTransfer(): bool
    {
        return $this->slug === self::BANKTRANSFER;
    }

    public function isBillPayment(): bool
    {
        return in_array($this->slug, [self::AIRTIME, self::MTN, self::GLO, self::NINEMOBILE, self::ETISALAT, self::AIRTEL, self::DATA, self::CABLETV, self::ELECTRICITY]);
    }
}
