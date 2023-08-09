<?php

namespace App\Http\Controllers\merchant;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductRequest;
use App\Models\merchant\Product;
use App\Traits\APIResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ProductsController extends Controller
{
    use APIResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddProductRequest $request)
    {
        $merchant = Auth::guard('merchant-api')->user();
        $locales = array_keys(LaravelLocalization::getSupportedLocales());
        $productExistsQB = $merchant->products();
        $counter=1;
//        dd($request->name);
        foreach ($request->name as $localeName){
            if($counter==1) {
                $productExistsQB->where('name','like',"%$localeName%");
            }else{
                $productExistsQB->orWhere('name','like',"%$localeName%");
            }
            $counter++;
        }
        $productExists = $productExistsQB->count();
        if($productExists){
            return $this->sendError(null,'Product has been already added before');
        }
        $product_data = [
            'name'          => serialize($request->name),
            'description'   => serialize($request->description),
            'vat_percentage'=> $merchant->vat_percentage
        ];

        $vatPercent = $merchant->vat_percentage*0.01;
        if($merchant->is_vat_included){
            $price          = round($request->price/(1+$vatPercent),2);
            $priceWithVAt   = round($request->price,2);
            $vatAmount      = round($priceWithVAt-$price,2);
        }else{
            $price          = round($request->price,2);
            $vatAmount      = round($price*$vatPercent,2);
            $priceWithVAt   = round($price+$vatAmount,2);
        }
        $product_data['price']=$price;
        $product_data['vat_amount']=$vatAmount;
        $product_data['price_with_vat']=$priceWithVAt;
        if ($merchant->products()->save(new Product($product_data))) {
            return  $this->sendSuccess(null,'Product has been added successfully');
        }
        return $this->sendError(null,"Failed to add product");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
