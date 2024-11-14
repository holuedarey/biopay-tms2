<?php

namespace App\Helpers;


//use App\Repository\Teqrypt;

class MyResponse
{
    public static function success($message = '', $data = null, $statusCode = null): \Illuminate\Http\JsonResponse
    {
        /*if ( !is_null($data) ) {
            $teqrypt = new Teqrypt();
            $data = $teqrypt->encrypt(json_encode($data));
            $data = $data['success'] === true ? $data['data'] : null;
        }*/

        return response()->json([
            'success'   => true,
            'message'   => $message,
            'data'      => $data,
            'statusCode' => $statusCode,
        ]);
    }

    public static function failed($message = '', $data = null, $code = 200,$statusCode = null): \Illuminate\Http\JsonResponse
    {
        /*if ( !is_null($data) ) {
            $teqrypt = new Teqrypt();
            $data = $teqrypt->encrypt(json_encode($data));
            $data = $data['success'] === true ? $data['data'] : null;
        }*/

        return response()->json([
            'success'   => false,
            'message'   => $message,
            'data'      => $data,
            'statusCode' => $statusCode,
        ], $code);
    }
}
