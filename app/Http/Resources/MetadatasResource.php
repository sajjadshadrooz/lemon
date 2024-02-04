<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\SubMetadatasResource;

class MetadatasResource extends JsonResource
{
    
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'title' => $this->title,
            'comment' => $this->comment,
            'subMetadatas' => SubMetadatasResource::collection($this->subMetadatas),
        ];
    }
}
