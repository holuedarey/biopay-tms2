<?php

namespace App\Models;

use App\Exceptions\FailedApiResponse;
use App\Traits\BelongsToSuperAgent;
use Cjmellor\Approval\Concerns\MustBeApproved;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Terminal extends Model
{
    use HasFactory, MustBeApproved, BelongsToSuperAgent;

    protected $guarded = ['id'];

    protected $appends = [
        'is_active'
    ];

    protected $casts = [
        'pin' => 'hashed',
        'admin_pin' => 'hashed'
    ];

    public function getRouteKeyName()
    {
        return 'serial';
    }

    /**
     * @return BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function processors()
    {
        return $this->hasMany(TerminalProcessor::class, 'serial');
    }

    /**
     * @return BelongsTo
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(TerminalGroup::class, 'group_id');
    }

    public function menus(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'service_terminal')
            ->withTimestamps();
    }

//    Attributes

    /**
     * @return Attribute
     */
    public function isActive(): Attribute
    {
        return Attribute::get(
            fn($value) => $this->status == 'ACTIVE'
        );
    }

    /**
     * Change the terminal status to the opposite value
     */
    public function changeStatus(): void
    {
        $this->status = $this->status == 'ACTIVE' ? 'INACTIVE' : 'ACTIVE';
        $this->save();
    }

    /**
     * @throws FailedApiResponse
     */
    public function ensureForTransaction(): void
    {
        if (!$this->is_active)
            throw new FailedApiResponse("Your Terminal is $this->status");
    }

    /**
     * Count the terminals grouped by status.
     *
     * @return object<string, int>
     */
    public static function countByStatus(): object
    {
        $terminals = self::groupBy('status')->selectRaw('count(*) as total, status')->orderBy('status')->get();

        return (object) [
            'active' => $terminals->where('status', 'ACTIVE')->first()->total ?? 0,
            'inactive' => $terminals->where('status', 'INACTIVE')->first()->total ?? 0,
        ];
    }

    public static function generateTid(string $phone = null)
    {
        retry:

        if ( is_null( $phone ) ) {
            $tid = '2023' . Str::random(4);
        }
        else {
            $tid = substr($phone, strlen($phone) - 8, 8);
        }

        if ( Terminal::where('tid', $tid)->count() > 0 ) {
            if (!is_null($phone) ) $phone = null;

            goto retry;
        }

        return $tid;
    }
}
