<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'u_email' => ['required', 'email'],
            'u_pw' => ['required'],
        ]);

        // 나중에 '나 기억하기' 값 받아오면 attempt 두번째 인자에 true 넣기
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * 회원가입
     *
     * @param  \Illuminate\Http\Request  $request
     * [카카오키, 네이버키, 이름(필), 닉네임(필), 배경이미지, 이메일(필), 비밀번호(필), 프로필이미지, 액세스토큰, 전화번호(필), 개인고유통관번호, 이용약관동의(필)]
     * @return \Illuminate\Http\Response
     * 로그인 화면으로 이동
     */
    public function registration(Request $request)
    {
        // 유효성 검사된 애들이랑
        // 이메일/폰 이랑 이메일/폰 인증코드 들고와서
        $request->validate([

        ]);
    }
}
