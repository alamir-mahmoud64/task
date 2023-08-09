<?php

namespace App\Http\Controllers\consumer;

use App\Http\Controllers\Controller;
use App\Http\Requests\consumer\ConsumerRegistrationRequest;
use App\Http\Resources\consumer\ConsumerResource;
use App\Models\consumer\Consumer;
use App\Traits\APIResponseTrait;
use Illuminate\Support\Facades\Hash;

class ConsumerRegistrationController extends Controller
{
    use APIResponseTrait;
    public function register(ConsumerRegistrationRequest $request)
    {
        $consumer = Consumer::create(
            [
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password)
            ]);
        if(!$consumer){
            return $this->sendError(null,'failed to complete registration');
        }
        $token = $consumer->createToken('Consumer', ['consumer'])->accessToken;
        $data=[
            'consumer'  => new ConsumerResource($consumer),
            'token'     => $token
        ];
        return $this->sendSuccess($data,'Successful Registration');
    }
}
