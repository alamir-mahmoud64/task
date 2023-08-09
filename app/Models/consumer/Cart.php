<?php

namespace App\Models\consumer;

use App\Models\merchant\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable =[
        'consumer_id',
        'product_id',
        'quantity',
        'unit_price',
        'vat_percentage',
        'vat_amount',
        'unit_price_with_vat',
        'total_price',
        'total_vat_amount',
        'total_price_with_vat'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
