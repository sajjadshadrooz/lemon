<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Metadata;

class SubMetadata extends Model
{
    use HasFactory;

    public function metadata(): BelongsTo
    {
        return $this->BelongsTo(Metadata::class);
    }
}
