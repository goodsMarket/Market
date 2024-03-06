<?php

namespace App\Http\Middleware;

use App\Modules\ValidatorList;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MyRegistUserValidate
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
            "u_pw" => "required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/|min:8|max:20|confirmed",
            "u_pw_confirmation" => "required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/|min:8|max:20",
            "u_phone_num" => "required|unique:users,u_phone_num|regex:/^01\d+$/|size:11",
        ];
        
        // 유효성 검사
        $validator = Validator::make($request->all(), $comparableValue);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        return $next($request);
    }
}
