<?php

namespace App\Http\Controllers;

use App\Mail\EmailVerify;
use App\Models\EmailVerified;
use App\Modules\ValidatorList;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class EmailController extends Controller
{
    /**
     * 이메일 인증 발송/재발송 버튼 메소드
     * $requset = { email:string }
     * @param  \Illuminate\Http\Request  $request
     */
    public function send(Request $request)
    {
        try {
            // 10분 안에 10번만 가능
            $nowCompareValue = ["u_email" => ValidatorList::$email];

            // 유효성 검사
            $validator = Validator::make($request->all(), $nowCompareValue);

            if ($validator->fails()) {
                throw new Exception($validator->errors());
            }

            // 현재 시간으로부터 10분 전의 시간을 구합니다.
            $currentTime = Carbon::now();
            $tenMinutesAgo = $currentTime->subMinutes(10);

            // 10분 전의 시간과 비교하여 몇 개인지 카운트
            $records = EmailVerified::where('email', $request->u_email)
            ->where('ev_send_time', '>=', $tenMinutesAgo)
            ->orderByDesc('ev_send_time')
            ->count();

            // 10개 이상으로 요청오면 캐치
            if ($records > 10) {
                throw new Exception('이메일 인증은 10분에 10번까지만 가능합니다. 잠시 후에 다시 보내주세요');
            }

            // 유저한테서 이메일 주소를 받고 레코드 생성
            $emailVerified = EmailVerified::create([
                'email' => $request->u_email,
                'ev_token' => mt_rand(100000, 999999),
            ]);

            // 메일 보내기
            Mail::to($request->u_email)->send(new EmailVerify($emailVerified));

            // return true;
            return response()->json(['message' => '메일을 송신하였습니다.']);
        } catch (Exception $e) {
            // return false;
            $error = json_decode($e->getMessage()) !== null ? json_decode($e->getMessage()) : $e->getMessage();
            return response()->json(['error' => $error]);
        }
    }

    /**
     * 이메일 & 토큰 체크
     *
     * @param  \Illuminate\Http\Request  $request
     * $request = { u_email:string, ev_token:sting }
     * @return boolean
     */
    public function check(Request $request)
    {
        try {
            // 프론트에서는 5분 안에, 백엔드에서는 제한 없음

            $nowCompareValue = ["u_email" => ValidatorList::$email];

            // 유효성 검사
            $validator = Validator::make($request->all(), $nowCompareValue);

            if ($validator->fails()) {
                throw new Exception($validator->errors());
            }

            // 현재 시간으로부터 5분 전의 시간을 구합니다.
            $currentTime = Carbon::now();
            $tenMinutesAgo = $currentTime->subMinutes(5);

            // 이메일과 토큰을 받아서 레코드에 일치하는 게 있나 체크
            $emailVerified = EmailVerified::where('email', $request->u_email)
                ->where('ev_token', $request->ev_token)
                ->orderByDesc('ev_send_time')
                ->first();

            // 없으면 예외
            if (empty($emailVerified->all())) {
                throw new Exception('토큰이 올바르지 않습니다.');
            }

            // 시간 만료 예외
            if ($emailVerified->ev_send_time < $tenMinutesAgo) {
                throw new Exception('만료된 토큰 입니다.');
            }

            return response()->json(['message' => '인증되었습니다.']);
        } catch (Exception $e) {
            $error = json_decode($e->getMessage()) !== null ? json_decode($e->getMessage()) : $e->getMessage();
            return response()->json(['error' => $error]);
        }
    }
}
