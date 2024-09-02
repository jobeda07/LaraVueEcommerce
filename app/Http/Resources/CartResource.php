<?php

namespace App\Http\Resources;

use App\Helper\CartHelper;
use App\Http\Resources\Backend\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        [$products,$cartItems]=$this->resource;
        return [
            'count'=>CartHelper::getCount(),
            'total' => round($products->reduce(fn (?float $carry, Product $product) => $carry + $product->price * $cartItems[$product->id]['quantity'], 0), 2),
            'items'=>$cartItems,
            'products'=>ProductResource::collection($products)
        ];
    }
}
