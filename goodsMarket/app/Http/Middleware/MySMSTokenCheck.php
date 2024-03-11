<?php

namespace App\Http\Middleware;

use App\Models\PhoneVerified;
use App\Modules\ValidatorList;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MySMSTokenCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * $request = { phone:sting, pv_token:sting }
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            // 프론트에서는 5분 안에, 백엔드에서는 제한 없음

            $nowCompareValue = ["u_phone_num" => ValidatorList::$phone];

            // 유효성 검사
            $validator = Validator::make($request->all(), $nowCompareValue);
            
            if ($validator->fails()) {
                throw new Exception($validator->errors());
            }

            // 이메일과 토큰을 받아서 레코드에 일치하는 게 있나 체크
            $emailVerified = PhoneVerified::where('phone', $request->u_phone_num)
                ->where('pv_token', $request->pv_token)
                ->get();

            // 없으면 예외
            if(empty($emailVerified->all())){
                throw new Exception('휴대전화 토큰이 올바르지 않습니다.');
            }

            // return response()->json(['message' => '인증되었습니다.']);
            return $next($request);
        } catch (Exception $e) {
            return response()->json(['errors' => $e->getMessage()]);
        }
    }
}
