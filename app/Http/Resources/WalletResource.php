<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WalletResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user' => $this->user,
            'balance' => $this->balance,
            'active' => $this->active,
            'active_updated_at' => $this->active_updated_at,
        ];
    }
}
