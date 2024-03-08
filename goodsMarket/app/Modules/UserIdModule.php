<?php

namespace App\Modules;

class UserIdModule
{
    /**
     * 쿠키로 유저아이디 비교
     * @param array|string|null $cookieValue
     * @param int $writerId
     * @return void|\Illuminate\Http\JsonResponse
     */
    public static function check($cookieValue, $writerId) {        
        // 세션은 이름 뒤에 아이디값이 있는데 이게 쿠키에 있다.
        $nowUserID = MyModule::myDecrypt($cookieValue);
        if ((int) $writerId !== (int) $nowUserID) {
            return response()->json(['errors' => '작성자가 일치하지 않습니다.']);
        }
    }
}