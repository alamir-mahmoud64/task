<?php

namespace App\Models\merchant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable =[
        'merchant_id',
        'name',
        'description',
        'price',
        'vat_percentage',
        'vat_amount',
        'price_with_vat'
    ];

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }
}
