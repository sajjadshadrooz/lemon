<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\SubMetadata;

class Metadata extends Model
{
    use HasFactory;


    public function child(): HasMany
    {
        return $this->hasMany(Metadata::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Metadata::class);
    }

    public function subMetadatas(): HasMany
    {
        return $this->hasMany(SubMetadata::class);
    }

}
