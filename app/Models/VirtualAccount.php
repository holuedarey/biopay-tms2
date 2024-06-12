<?php

namespace App\Models;

use App\Jobs\CreditVirtualAccount;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class   VirtualAccount extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'meta' => 'object'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function credits(): HasMany
    {
        return $this->hasMany(VirtualAccountCredit::class, 'virtual_account_id');
    }

    public function processCredit(Collection $data): void
    {
        dispatch(new CreditVirtualAccount($this, $data));
    }
}
