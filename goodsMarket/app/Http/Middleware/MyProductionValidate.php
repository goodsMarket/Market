<?php

namespace App\Http\Middleware;

use App\Modules\MyModule;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MyProductionValidate
{
    /**
     * 보드 관련 정보를 유효성 검사후 패스 or 오류
     *
     * @param  Request $request 안에 보드값
     * @param  Closure
     * @return Response|RedirectResponse 성공 후 다음작업 | 오류 반환
     */
    public function handle(Request $request, Closure $next)
    {
        // 리퀘스트에 지정해놓은 값들이 있으면
        $comparableValue = [
            "writer_id" => "required|exists:users,id",

            // 굿즈제작
            "p_title" => "required|between:1,50",
            "p_start_date" => "required|date|before:end_date",
            "p_end_date" => "required|date|after:start_date",
            "p_schedule" => "required|numeric",
            "p_content" => "required|between:1,3000",
            "p_age_limit" => "required|boolean",
            "p_password" => "regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()\-_=+\\|\[\]{};:'\",.<>/?]).{4,20}$/",
            "p_thumbnail" => "required", // 이미지 주소
            "p_notice_agreement" => "required|boolean",
            // "p_twitter" => "required",
            // "p_instagram" => "required",
            "p_question" => "between:1,254",
        ];

        // 그 값들만 남겨서
        $nowCompareValue = [];
        
        // 세션과 쿠키의 값을 가져옵니다.
        $cookieValue = $request->cookie('user_id');

        // 세션은 이름 뒤에 아이디값이 있는데 이게 쿠키에 있다.
        $nowUserID = MyModule::myDecrypt($cookieValue);
        foreach($comparableValue as $key => $value) {
            // if($request->has($key)) {
            //     $nowCompareValue[$key] = $value;
            // }
            if($key === 'writer_id' && $value !== $nowUserID){
                return response()->json(['errors' => '작성자가 일치하지 않습니다.'], 500);
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
