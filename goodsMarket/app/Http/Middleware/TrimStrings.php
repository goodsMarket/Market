<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;

class TrimStrings extends Middleware
{
    /**
     * The names of the attributes that should not be trimmed.
     *
     * @var array<int, string>
     */
    protected $except = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * 좌우 공백 제거
     * 
     * @param \Illuminate\Http\Request $request -> :string 공백있는 문자열
     * @return string 공백제거 문자열
     */
    public function handle($request, Closure $next)
    {
        $input = $request->all();

        // 배열의 모든 값을 트림
        $trimmed = array_map(function ($value) {
            return is_string($value) ? trim($value) : $value;
        }, $input);

        // 트림된 값을 요청에 다시 설정
        $request->merge($trimmed);

        return $next($request);
    }
}
