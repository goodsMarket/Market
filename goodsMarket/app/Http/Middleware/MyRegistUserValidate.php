<?php

namespace App\Http\Middleware;

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
     * @return Response|RedirectResponse 성공 후 다음작업 | 오류 반환
     */
    public function handle(Request $request, Closure $next)
    {
        // 리퀘스트에 지정해놓은 값들이 있으면
        $comparableValue = [
            "u_name" => "required|regex:/^[가-힣A-Za-z\s]+$/|min:2|max:10",
            "u_nickname" => "required|unique:users,u_nickname|regex:/^[가-힣A-Za-z]+$/|min:2|max:10",
            "u_email" => "required|unique:users,u_email|email",
            "u_pw" => "required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/|min:8|max:20|confirmed",
            "u_pw_confirmation" => "required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/|min:8|max:20",
            "u_phone_num" => "required|unique:users,u_phone_num|regex:/^01\d+$/|size:12",
        ];

        // // 그 값들만 남겨서 240220: 값 하나만 보내면 버그 아닌가?
        // $nowCompareValue = [];

        // foreach($comparableValue as $key => $value) {
        //     if($request->has($key)) {
        //         $nowCompareValue[$key] = $value;
        //     }
        // }

        // 유효성 검사
        $validator = Validator::make($request->all(), $comparableValue);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        return $next($request);
    }
}
