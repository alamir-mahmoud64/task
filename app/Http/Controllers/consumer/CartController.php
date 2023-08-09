<?php

namespace App\Http\Controllers\consumer;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddToCartRequest;
use App\Http\Resources\CartResource;
use App\Models\consumer\Cart;
use App\Models\merchant\Merchant;
use App\Models\merchant\Product;
use App\Traits\APIResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    use APIResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consumer = Auth::guard('consumer-api')->user();
        $cartItems = $consumer->carts()->with('product')->get();
        $totalItemsPrice = $cartItems->sum('total_price_with_vat');
        $totalShippingCost = Merchant::whereHas('products',function ($q)use($cartItems){
            $q->whereIn('id',$cartItems->pluck('product_id'));
        })->sum('shipping_cost');
        $cart = new Collection();
        $cart->totalItemsPrice = $totalItemsPrice;
        $cart->totalShippingCost = $totalShippingCost;
        $cart->cartItems = $cartItems;
        $data['cart'] = new CartResource($cart);
        return $this->sendSuccess($data,'');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddToCartRequest $request)
    {
        $consumer = Auth::guard('consumer-api')->user();
        $product = Product::find($request->product_id);
        $CartItem = Cart::where([
            ['product_id' , '=', $request->product_id],
            ['consumer_id' , '=', $consumer->id]
        ])->first();
        if($CartItem){
            $newQuantity = $request->quantity+$CartItem->quantity;
            $cart = $CartItem->update(
                [
                    'quantity'      => $newQuantity,
                    'unit_price'    => $product->price,
                    'vat_percentage'    => $product->vat_percentage,
                    'vat_amount'        => $product->vat_amount,
                    'unit_price_with_vat'   => $product->price_with_vat,
                    'total_price'           => $product->price*$newQuantity,
                    'total_vat_amount'      => $product->vat_amount*$newQuantity,
                    'total_price_with_vat'  => $product->price_with_vat*$newQuantity
                ]
            );
        }else{
            $cart = Cart::create([
                'product_id'    => $request->product_id,
                'consumer_id'   => $consumer->id,
                'quantity'      => $request->quantity,
                'unit_price'    => $product->price,
                'vat_percentage'    => $product->vat_percentage,
                'vat_amount'        => $product->vat_amount,
                'unit_price_with_vat'   => $product->price_with_vat,
                'total_price'           => $product->price*$request->quantity,
                'total_vat_amount'      => $product->vat_amount*$request->quantity,
                'total_price_with_vat'  => $product->price_with_vat*$request->quantity
            ]);
        }
        if($cart){
            return $this->sendSuccess(null,"Item has been added successfully to cart");
        }
        return $this->sendError(null,"Failed To Add Item To Cart");
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
