<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MyCreateUserValidate
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
            "u_name" => "required|regex:/^[가-힣A-Za-z]{2,30}$/",
            "u_nickname" => "required|unique:users,u_nickname|regex:/^[가-힣A-Za-z]{2,30}$/",
            // "u_back_img" => "", // TODO: 이거 파일 형태가 뭐지, 공격에 쓰일 수 있나
            "u_email" => "required|unique:users,u_email|email",
            "u_pw" => "required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/",
            // "u_profile_img" => "", // TODO: 위와 동일
            "u_phone_num" => "required|unique:users,u_phone_num|regex:/^01\d{9}$/",
            // "u_pccc" => "",
        ];
        
        // 그 값들만 남겨서
        $nowCompareValue = [];
        
        foreach($comparableValue as $key => $value) {
            if($request->has($key)) {
                $nowCompareValue[$key] = $value;
            }
        }
        
        // 유효성 검사
        $validator = Validator::make($request->all(), $nowCompareValue);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        return $next($request);
    }
}
