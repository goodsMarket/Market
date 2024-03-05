<?php

namespace App\Http\Middleware;

use App\Modules\MyModule;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MyUsedTradeValidate
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
        ];
        
        // 유효성 검사
        $validator = Validator::make($request->all(), $comparableValue);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        return $next($request);
    }
}
