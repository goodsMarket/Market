<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MyUserValidate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // 리퀘스트에 지정해놓은 값들이 있으면
        $comparableValue = [
            "u_name" => "required|regex:/^[가-힣A-Za-z]{2,30}$/",
            "u_nickname" => "required|regex:/^[가-힣A-Za-z]{2,30}$/",
            "u_back_img" => "", // TODO: 이거 파일 형태가 뭐지, 공격에 쓰일 수 있나
            "u_email" => "required|email",
            "u_pw" => "required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()\-_=+\\|\[\]{};:'\",.<>/?]).{8,20}$/",
            "u_profile_img" => "", // TODO: 위와 동일
            "u_phone_num" => "required",
            "u_pccc" => "",
        ];
        
        // 그 값들만 남겨서
        foreach($request as $key => $value) {

        }
        
        // 유효성 검사
        $validator = validator($request->only(['name', 'email']), $rules);

        if ($validator->fails()) {
            // 유효성 검사 실패 시 처리
            // 예: 에러 메시지와 함께 422 상태 코드로 응답
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        return $next($request);
    }
}
