<?php

namespace App\Http\Middleware;

use App\Modules\MyModule;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckUserSession
{
    /**
     * 로그인 안하면 반출
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // 세션과 쿠키의 값을 가져옵니다.
        $cookieValue = $request->cookie('user_id');

        // 세션은 이름 뒤에 아이디값이 있는데 이게 쿠키에 있다.
        $nowUserID = MyModule::myDecrypt($cookieValue);

        // 붙이고 호출
        $sessionValue = Session::get('user_id' . $nowUserID);

        // 세션과 쿠키의 값이 같은지 확인합니다.
        if ((String) $sessionValue !== (String) $cookieValue) {
            // 값이 일치하지 않을 경우, 요청을 거부합니다.
            return response()->json(['error' => '세션과 쿠키 값이 일치하지 않습니다.']);
        }

        // 값이 일치할 경우, 다음 미들웨어로 요청을 전달합니다.
        return $next($request);
    }
}
