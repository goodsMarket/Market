<?php

namespace App\Http\Middleware;

use App\Modules\ValidatorList;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class MyLoginValidate
{
    /**
     * 유저 관련 정보를 유효성 검사후 패스 or 오류
     *
     * @param  Request $request 안에 유저값
     * @param  Closure
     */
    public function handle(Request $request, Closure $next)
    {
        Log::debug('MyLoginValidate');
        Log::debug($request);
        // 리퀘스트에 지정해놓은 값들이 있으면
        $comparableValue = [
            "u_email" => "required|exists:users,u_email|email", // unique:users,u_email
            "u_pw" => ValidatorList::$password,
        ];
        
        // 유효성 검사
        $validator = Validator::make($request->all(), $comparableValue);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        return $next($request);
    }
}
