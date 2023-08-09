<?php

namespace App\Http\Controllers\merchant;

use App\Http\Controllers\Controller;
use App\Http\Requests\merchant\MerchantLoginRequest;
use App\Http\Resources\merchant\MerchantResource;
use App\Models\merchant\Merchant;
use App\Traits\APIResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MerchantLoginController extends Controller
{
    use APIResponseTrait;
    public function login(MerchantLoginRequest $request)
    {
        $merchant = Merchant::where('email',$request->email)->first();
        if($merchant && Hash::check($request->password,$merchant->password)){
            $data=[
                'merchant'  => new MerchantResource($merchant),
                'token'     => $merchant->createToken('Merchant', ['merchant'])->accessToken
            ];

            return $this->sendSuccess($data,'Successful Login');
        }

        return $this->sendError(null,'Invalid email or password');
    }
}
