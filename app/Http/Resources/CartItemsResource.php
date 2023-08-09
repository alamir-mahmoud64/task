<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'=>unserialize($this->product->name)[app()->getLocale()],
            'description'=>unserialize($this->product->description)[app()->getLocale()],
            'quantity'=>$this->quantity,
            'unit_price'=>$this->unit_price,
            'vat_percentage'=>$this->vat_percentage,
            'total_price'=>$this->total_price,
            'total_vat'=>$this->total_vat_amount,
            'total_amount'=>$this->total_price_with_vat
        ];
    }
}
