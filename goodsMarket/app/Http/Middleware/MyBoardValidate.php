<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MyBoardValidate
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
            // 중고거래
            "writer_id" => "required|exists:users,id",
            "c_id" => "required|exists:categories,id",
            "ut_title" => "required|between:1,50",
            "ut_price" => "required|numeric",
            "ut_count" => "required|numeric",
            "ut_quality" => "required|regex:/^[0-9]$/", // |exists:테이블 만들어서 관리하면 더 좋을 수 있음
            "ut_description" => "required|between:1,1000",
            "ut_refund" => "required|boolean",

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
        
        $userId = Auth::id();
        foreach($comparableValue as $key => $value) {
            if($request->has($key)) {
                $nowCompareValue[$key] = $value;
            }
            if($key === 'writer_id' && $value !== $userId){
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
