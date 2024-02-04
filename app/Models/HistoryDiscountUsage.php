<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HistoryDiscountUsage extends Model
{
    use HasFactory;

    protected $fillable = [
        'wallet',
        'discount',
        'status',
        'created_at',
    ];

    public $timestamps = false;

    public function discountPointer(): BelongsTo
    {
        return $this->belongsTo(Discount::class, 'discount');
    }

    public function walletPointer(): BelongsTo
    {
        return $this->belongsTo(Wallet::class, 'wallet');
    }
}
