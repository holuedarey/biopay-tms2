<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VirtualAccountCredit extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'meta'      => 'object',
        'paid_at'   => 'datetime'
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(VirtualAccount::class);
    }
}
