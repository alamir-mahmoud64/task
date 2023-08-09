<?php

namespace App\Http\Controllers\merchant;

use App\Http\Controllers\Controller;
use App\Http\Requests\merchant\MerchantRegistrationRequest;
use App\Http\Resources\consumer\ConsumerResource;
use App\Http\Resources\merchant\MerchantResource;
use App\Models\consumer\Consumer;
use App\Models\merchant\Merchant;
use App\Traits\APIResponseTrait;
use Illuminate\Support\Facades\Hash;

class MerchantRegistrationController extends Controller
{
    use APIResponseTrait;
    public function register(MerchantRegistrationRequest $request)
    {
        $request_data = $request->only([
            'first_name',
            'last_name',
            'store_name',
            'is_vat_included',
            'percentage',
            'email'
        ]);
        $request_data['password'] = Hash::make($request->password);
        if($request->shipping_cost){
            $request_data['shipping_cost'] = $request->shipping_cost;
        }
        $merchant = Merchant::create($request_data);
        if(!$merchant){
            return $this->sendError(null,'failed to complete registration');
        }
        $token = $merchant->createToken('Merchant', ['merchant'])->accessToken;
        $data=[
            'merchant'  => new MerchantResource($merchant),
            'token'     => $token
        ];
        return $this->sendSuccess($data,'Successful Registration');
    }
}
