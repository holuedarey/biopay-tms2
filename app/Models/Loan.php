<?php

namespace App\Models;

use App\Enums\Status;
use App\Traits\BelongsToSuperAgent;
use Cjmellor\Approval\Concerns\MustBeApproved;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Loan extends Model
{
    use HasFactory, BelongsToSuperAgent;

    protected $guarded = ['id'];

    protected $casts = [
        'status' => Status::class,
        'items' => 'array'
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isPending(): bool
    {
        return $this->status === Status::PENDING;
    }

    public function isApproved(): bool
    {
        return $this->status === Status::APPROVED;
    }

    public function scopeViewable(Builder $builder)
    {
        $user = auth()->user();

        $builder->latest()->when($user->isSuperAgent(),
            fn($query) => $query->whereRelation('user', fn($query) => $query->where('super_agent_id', $user->id))
        );
    }
}
