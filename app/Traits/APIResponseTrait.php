<?php

namespace App\Traits;

trait APIResponseTrait
{
    protected function sendSuccess($data=null,String $message="", Int $code = 200)
    {
        $response =[
            'success'   => true,
            'code'      => $code,
            'message'   => $message,
            'data'      => $data
        ];
        return response()->json($response,$code);
    }

    protected function sendError($data=null,String $message="", Int $code = 400, $errors=null)
    {
        $response =[
            'success'   => true,
            'code'      => $code,
            'message'   => $message,
            'data'      => $data,
            'errors'    => $errors
        ];
        return response()->json($response,$code);
    }
}
