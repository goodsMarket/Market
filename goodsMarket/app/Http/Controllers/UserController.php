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
use Illuminate\Support\MessageBag;

class UserController extends Controller
{
    /**
     * 로그인
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse 쿠키도 줌
     */
    public function authenticate(Request $request)
    {
        try {
            $email = request('u_email');
            $password = request('u_pw');

            // 데이터베이스에서 이메일로 사용자 조회
            $user = User::where('u_email', $email)->first();

            if ($user && Hash::check($password, $user->u_pw)) {
                // 비밀번호가 일치하면, 사용자를 로그인 처리
                Session::put('user_id' . $user->id, MyModule::myEncrypt($user->id));

                // 쿠키 생성
                $cookie = Cookie::make('user_id', MyModule::myEncrypt($user->id), 60); // 이름, 값, 유효기간(분)

                // 로그인 성공 후의 로직, 예를 들어 홈페이지로 리다이렉션
                $userId = Session::get('user_id');

                return response()->json(true)->withCookie($cookie);
                // return response()->json(['messsage' => $user->id . ' logined.'])->withCookie($cookie);
            } else {
                // 인증 실패 처리
                return response()->json(false);
                // throw new Exception('이메일 또는 비밀번호가 잘못되었습니다.');
            }
        } catch (Exception $e) {
            // 예외 처리 로직
            // return false;
            return response()->json(['error' => $e->getMessage()]);
        }
        // return back()->withErrors([
        //     'email' => 'The provided credentials do not match our records.',
        // ]);
    }

    /**
     * 로그아웃 처리
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function logout(Request $request)
    {
        try {
            // 쿠키의 값을 가져옵니다.
            $cookieValue = $request->cookie('user_id');

            // 세션은 이름 뒤에 아이디값이 있는데 이게 쿠키에 있다.
            $nowUserID = MyModule::myDecrypt($cookieValue);

            Session::forget('user_id' . $nowUserID);

            return response()->json(true)->withCookie(Cookie::forget('user_id'));
        } catch (Exception $e) {
            return response()->json(false);
        }
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
            User::create([
                'u_name' => $request->u_name,
                'u_nickname' => $request->u_nickname,
                'u_email' => $request->u_email,
                'u_pw' => Hash::make($request->u_pw),
                'u_phone_num' => $request->u_phone_num,
                'u_agree_flg' => $request->u_agree_flg,
            ]);

            return response()->json(['message' => '회원가입이 완료되었습니다.']);
        } catch (Exception $e) {
            // 예외 처리 로직
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    /**
     * 회원가입 파츠
     *
     * @param  \Illuminate\Http\Request  $request
     * 이름, 닉네임, 이메일, 비밀번호, 전화번호, 이용약관동의
     * @return 
     * 로그인 화면으로 이동
     */
    public function regist_part(Request $request)
    {
        try {
            $message = [];

            // 값 없으면 반환
            if (empty($request->all())) {
                throw new Exception('값을 입력하세요.');
            }

            // 리퀘스트에 지정해놓은 값들이 있으면
            $comparableValue = [
                "u_name" => "required|regex:/^[가-힣A-Za-z\s]+$/|min:2|max:10",
                "u_nickname" => "required|unique:users,u_nickname|regex:/^[가-힣A-Za-z]+$/|min:2|max:10",
                "u_nickname_chk" => "required|unique:users,u_nickname|regex:/^[가-힣A-Za-z]+$/|min:2|max:10",
                "u_email" => "required|unique:users,u_email|email",
                "u_pw" => "required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/|min:8|max:20|confirmed",
                "u_pw_confirmation" => "required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/|min:8|max:20",
                "u_phone_num" => "required|unique:users,u_phone_num|regex:/^01\d+$/|size:12",
            ];

            // 저장할 배열
            $nowCompareValue = [];

            // 있는지 보고 추가
            foreach ($comparableValue as $key => $value) {
                if ($request->has($key)) {
                    $nowCompareValue[$key] = $value;
                    $message[$key] = ['사용 가능합니다'];
                }
            }

            // 유효성 검사
            $validator = Validator::make($request->all(), $nowCompareValue);

            if ($validator->fails()) {
                throw new Exception($validator->errors());
            }
            // MessageBag::class;

            // 유효성 검사 후 반환
            return response()->json(['message' => $message]);
        } catch (Exception $e) {
            // return response()->json($e->getMessage());
            $decode = json_decode($e->getMessage());
            return response()->json(['error' => $decode]);
        }
    }
}
