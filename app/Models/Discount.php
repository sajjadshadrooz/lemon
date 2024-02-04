<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'type',
        'amount',
        'start_at',
        'expire_at',
        'max_usage',
        'max_capacity'
    ];

    public function historyDiscountUsage(): HasMany
    {
        return $this->hasMany(HistoryDiscountUsage::class, 'discount');
    }



}
