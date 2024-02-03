<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Metadatas;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubMetadatas extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'title',
        'comment',
        'metadata',
    ];

    public function metadata(): BelongsTo
    {
        return $this->BelongsTo(Metadatas::class, 'metadata');
    }
}
