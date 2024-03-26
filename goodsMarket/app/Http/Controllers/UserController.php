<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Modules\MyModule;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function authenticate(Request $request)
    {
        try {
            $email = request('u_email');
            $password = request('u_pw');
            // Log::debug($email);
            // Log::debug($password);

            // 데이터베이스에서 이메일로 사용자 조회
            $user = User::where('u_email', $email)->first();
            // Log::debug($user);

            if ($user && Hash::check($password, $user->u_pw)) {
                // 비밀번호가 일치하면, 사용자를 로그인 처리
                Session::put('user_id' . $user->id, MyModule::myEncrypt($user->id));

                // 쿠키 생성
                $cookie = Cookie::make('user_id', MyModule::myEncrypt($user->id), 60); // 이름, 값, 유효기간(분)

                // 로그인 성공 후의 로직, 예를 들어 홈페이지로 리다이렉션
                return response()->json(['message' => "반갑습니다 " . $user->u_nickname . "님"], 200)->withCookie($cookie);
            } else {
                // 인증 실패 처리
                throw new Exception('이메일 또는 비밀번호가 잘못되었습니다.');
            }
        } catch (Exception $e) {
            // 예외 처리 로직
            return response()->json(['error' => $e->getMessage()], 500);
        }
        // return back()->withErrors([
        //     'email' => 'The provided credentials do not match our records.',
        // ]);
        // return response()->json(['error' => 'unexpected error'], 500);
    }

    /**
     * 로그아웃 처리
     */
    public function logout()
    {
        Session::forget('user_id');
        Session::forget('is_logged_in');

        return redirect('login');
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

        // 회원가입
        try {
            // 데이터베이스 쿼리 실행
            $users = User::create([
                'u_name' => $request->u_name,
                'u_nickname' => $request->u_nickname,
                'u_email' => $request->u_email,
                'u_pw' => Hash::make($request->u_pw),
                'u_phone_num' => $request->u_phone_num,
                'u_agree_flg' => $request->u_agree_flg,
            ]);

            // 쿼리 결과를 사용한 로직...
        } catch (Exception $e) {
            // 예외 처리 로직
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['message' => $users->nickname . '유저생성 완료'], 200);

    }
}
