<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Transaction;

class Wallet extends Model
{
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class); 
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class); 
    }
}
