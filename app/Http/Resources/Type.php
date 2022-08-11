<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Type extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'tenLoai' => $this->tenLoai,            
            'updated_at' => $this->updated_at->format('d/m/Y'),
            'created_at' => $this->created_at->format('d/m/Y'),
        ];
    }
}
