<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'image' => $this->image ? asset($this->image) : null,
            'category' => [
                'id' => $this->category->id,
                'name' => $this->category->name,
            ],
            'status' => $this->status,
            'status_label' => $this->getStatusLabel(),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
