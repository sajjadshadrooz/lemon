<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\WalletResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'fistname' => $this->firstName,
            'lastname' => $this->lastName,
            'username' => $this->userName,
            'mobile' => $this->mobile,
            'email' => $this->email,
            'wallet' => new WalletResource($this->wallet),
        ];
    }
}
