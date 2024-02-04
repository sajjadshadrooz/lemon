<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'active',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user'); 
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'wallet'); 
    }

    public function historyDiscountUsage(): HasMany
    {
        return $this->hasMany(HistoryDiscountUsage::class, 'wallet');
    }
}
