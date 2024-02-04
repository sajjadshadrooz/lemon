<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Wallet;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'wallet',
        'type',
        'amount',
        'balance',
        'from',
        'to',
        'created_at'
    ];

    public $timestamps = false;

    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class, 'wallet');
    }
}
