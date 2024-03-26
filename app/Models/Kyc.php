<?php

namespace App\Models;

use App\Traits\BelongsToSuperAgent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kyc extends Model
{
    use HasFactory, BelongsToSuperAgent;

    protected $guarded = ['id'];

    protected $casts = [
        'verified_at' => 'datetime'
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(Document::class, 'document_id');
    }

    public function isVerified(): bool
    {
        return ! is_null($this->verified_at);
    }
}
