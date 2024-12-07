<?php

namespace App\Services\Api;

use Illuminate\Http\JsonResponse;

class ResponseApi
{

    // returnDataSuccess
    public static function returnDataSuccess($model,$msg,$code=200): JsonResponse
    {
        return response()->json([
            'data' => $model,
            'msg' => $msg,
            'status'=> 1
        ],$code);
    }
    // returnDataFail
    public static function returnDataFail($model,$msg,$code): JsonResponse
    {
        return response()->json([
            'data' => $model,
            'msg' => $msg,
            'status'=> 0
        ],$code);
    }
    // get random token by length string
    public static function randomToken($length_of_string): string
    {
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz!@#$%&';
        return substr(str_shuffle($str_result), 0, $length_of_string);
    }


    public static function uploadImage($image, $folderName = null)
    {
        return $image->store('uploads/'.$folderName??'default'.'/images', 'public');
    }
}
