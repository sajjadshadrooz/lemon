<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\SubMetadatas;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Metadatas extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'title',
        'comment',
    ];

    public function child(): HasMany
    {
        return $this->hasMany(Metadatas::class, 'parent');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Metadatas::class, 'parent');
    }

    public function subMetadatas(): HasMany
    {
        return $this->hasMany(SubMetadatas::class, 'metadata');
    }

}
