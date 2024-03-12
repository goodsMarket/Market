<?php

namespace App\Http\Middleware;

use App\Modules\MyModule;
use App\Modules\MyRes;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MyWriterdValidate
{
    /**
     * 작성자 체크
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
        // Log::debug($nowUserID);
        if ((int) $request->writer_id !== (int) $nowUserID) {
            return MyRes::err('작성자가 일치하지 않습니다.');
        }

        return $next($request);
    }
}
