<?php

namespace App\Http\Resources;

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
        return [
            'cartItems'     => CartItemsResource::collection($this->cartItems),
            'totalAmount'   => $this->totalItemsPrice,
            'shippingCost'  => $this->totalShippingCost
        ];
    }
}
