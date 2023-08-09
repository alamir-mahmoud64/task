<?php

namespace App\Http\Controllers\consumer;

use App\Http\Controllers\Controller;
use App\Http\Requests\consumer\ConsumerLoginRequest;
use App\Http\Resources\ConsumerResource;
use App\Models\consumer\Consumer;
use App\Traits\APIResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ConsumerLoginController extends Controller
{
    use APIResponseTrait;
    public function login(ConsumerLoginRequest $request)
    {
        $consumer = Consumer::where('email',$request->email)->first();
        if($consumer && Hash::check($request->password,$consumer->password)){
            $data=[
                'consumer'  => new ConsumerResource($consumer),
                'token'     => $consumer->createToken('Consumer', ['consumer'])->accessToken
            ];

            return $this->sendSuccess($data,'Successful Login');
        }

        return $this->sendError(null,'Invalid email or password');
    }
}
