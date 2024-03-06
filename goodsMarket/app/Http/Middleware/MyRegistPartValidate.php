<?php

namespace App\Http\Middleware;

use App\Modules\ValidatorList;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MyRegistPartValidate
{
    /**
     * (회원가입용)유저 관련 정보를 유효성 검사후 패스 or 오류
     *
     * @param  Request $request 안에 유저값
     * @param  Closure
     */
    public function handle(Request $request, Closure $next)
    {
        // 리퀘스트에 지정해놓은 값들이 있으면
        $comparableValue = [
            "u_name" => ValidatorList::$name,
            "u_nickname" => ValidatorList::$nickname,
            "u_email" => "required|unique:users,u_email|email",
            "u_pw" => ValidatorList::$password,
            "u_phone_num" => ValidatorList::$phone,
        ];

        // 저장할 배열
        $nowCompareValue = [];

        // 키값 저장
        $nowKeys = [];

        // 있는지 보고 추가
        foreach ($comparableValue as $key => $value) {
            if ($request->has($key)) {
                $nowCompareValue[$key] = $value;
                $nowKeys[] = $key;
            }
        }

        // 유효성 검사
        $validator = Validator::make($request->all(), $nowCompareValue);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        return $next($request);
    }
}
