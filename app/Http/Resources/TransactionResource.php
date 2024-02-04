<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'wallet' => $this->wallet,
            'type' => $this->type,
            'amount' => $this->amount,
            'balance' => $this->balance,
            'from' => $this->from,
            'to' => $this->to,
            'created_at' => $this->created_at,
        ];
    }
}
