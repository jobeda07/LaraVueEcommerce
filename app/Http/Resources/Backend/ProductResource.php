<?php

namespace App\Http\Resources\Backend;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' =>$this->id,
            'name' =>$this->name,
            'price' =>$this->price,
            'category' => $this->category ? new CategoryResource($this->category) : 'N/A',
            'brand' => $this->brand ? new BrandResource($this->brand) : 'N/A',
            'created_at'=>$this->created_at->toFormattedDateString()
        ];
    }
}
