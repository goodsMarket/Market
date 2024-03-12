<?php
namespace App\Modules;

use App\Models\BoardImg;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MyRes
{
    public static function res($message, $cookie = null){
        $return = response()->json(['message' => $message]);

        if(isset($cookie)){
            return $return->withCookie($cookie);
        } else {
            return $return;
        }
    }

    public static function err($getMessage) {
        $error = json_decode($getMessage) !== null ? json_decode($getMessage) : $getMessage;
        return response()->json(['error' => $error]);
    }
}