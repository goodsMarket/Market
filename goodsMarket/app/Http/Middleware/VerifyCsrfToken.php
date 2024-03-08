<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        '/regist',
        '/regist/part',
        '/regist/mail',
        '/regist/mail/check',
        '/regist/sms',
        '/regist/sms/check',
        '/login',
        // '/logout',
        '/board/used-trade',
        '/board/image',
    ];
}
