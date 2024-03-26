<?php

namespace App\Models;

use App\Enums\Documents;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class KycLevel extends Model
{
    use HasFactory, LogsActivity;

    const SILVER = 1;
    const GOLD = 2;
    const DIAMOND = 3;
    const MERCHANT = 4;

    protected $guarded = ['id'];

    protected $appends = ['required_doc'];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'level_id');
    }

    /**
     * The roles that belong to the user.
     */
    public function documents(): BelongsToMany
    {
        return $this->belongsToMany(Document::class, 'document_level');
    }

    public function name(): Attribute
    {
        return Attribute::set(fn($value) => strtoupper($value));
    }

    public function documentName(): Attribute
    {
        return Attribute::get(
            fn() => $this->documents->pluck('name')->implode(', ')
        );
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('KycLevel')
            ->logOnly(['name', 'daily_limit']);
    }

    public function requiredDoc(): Attribute
    {
        return Attribute::get(fn() => match ($this->id) {
            1 => null,
            2 => 'BVN',
            3 => Documents::ID->name() . '/' . Documents::UTILITY->name(),
            4 => Documents::CAC->name(),
        });
    }
}
