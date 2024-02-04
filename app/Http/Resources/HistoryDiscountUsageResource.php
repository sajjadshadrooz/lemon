<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HistoryDiscountUsageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'wallet' => new WalletResource($this->wallet),
            'user' => new UserResource($this->wallet()->user),
            'status' => $this->status,
            'created_at' => $this->created_at,
        ];
    }
}
