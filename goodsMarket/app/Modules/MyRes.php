<?php
namespace App\Modules;

use App\Models\BoardImg;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MyRes
{
    /**
     * 기본 메세지 반환
     * @param mixed $message
     * @param array|string|null $cookie
     * @return \Illuminate\Http\JsonResponse
     */
    public static function res($message, $cookie = null)
    {
        $return = response()->json(['message' => $message]);

        if (isset($cookie)) {
            return $return->withCookie($cookie);
        } else {
            return $return;
        }
    }

    /**
     * --- 많이 안씀: 클라이언트에서 한번만 가져오고 재사용함 ---
     * 기본 + csrf 반환
     * @param mixed $message
     * @param array|string|null $cookie
     * @return \Illuminate\Http\JsonResponse [message, csrf]
     */
    public static function csrf($message, $cookie = null)
    {
        $return = response()->json([
            'message' => $message,
            'csrf' => csrf_token(),
        ]);

        if (isset($cookie)) {
            return $return->withCookie($cookie);
        } else {
            return $return;
        }
    }

    public static function err($getMessage)
    {
        $error = json_decode($getMessage) !== null ? json_decode($getMessage) : $getMessage;
        return response()->json(['error' => $error]);
    }
}