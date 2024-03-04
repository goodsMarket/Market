<?php

namespace App\Http\Controllers;

use App\Mail\EmailVerify;
use App\Models\EmailVerified;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
     /**
     * 이메일 인증 발송버튼 메소드
     *
     * @param  \Illuminate\Http\Request  $request
     * @return boolean
     */
    public function send(Request $request)
    {
        try {
            // 10분 안에 10번만 가능

            // 현재 시간으로부터 10분 전의 시간을 구합니다.
            $currentTime = Carbon::now();
            $tenMinutesAgo = $currentTime->subMinutes(10);

            // 10분 전의 시간과 비교하여 몇 개인지 카운트
            $records = EmailVerified::where('ev_send_time', '>=', $tenMinutesAgo)->count();

            // 10개 이상으로 요청오면 캐치
            if($records > 10) {
                throw new Exception('이메일은 10분에 10번까지만 가능합니다.');
            }

            // 유저한테서 이메일 주소를 받고 레코드 생성
            $emailVerified = EmailVerified::create([
                'email' => $request->email,
                'token' => mt_rand(100000, 999999),
            ]);

            // 메일 보내기
            Mail::to($request->email)->send(new EmailVerify($emailVerified));

            // return true;
            return response()->json(['message' => '성공']);
        } catch (Exception $e) {
            // return false;
            return response()->json(['message' => $e->getMessage()]);
        }
    }
}
