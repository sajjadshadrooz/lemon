<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Wallet;

class Transaction extends Model
{
    use HasFactory;


    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }
}
