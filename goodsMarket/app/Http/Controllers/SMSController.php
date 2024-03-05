<?php

namespace App\Http\Controllers;

use App\Models\PhoneVerified;
use App\Modules\ValidatorList;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Vonage\Client;
use Vonage\Client\Credentials\Basic;
use Vonage\SMS\Message\SMS;

class SMSController extends Controller
{
    /**
     * 휴대폰 인증 발송버튼 메소드
     * $requset = { phone:string }
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function send(Request $request)
    {
        try {
            // 10분 안에 10번만 가능

            $nowCompareValue = ["phone" => ValidatorList::$phone];

            // 유효성 검사
            $validator = Validator::make($request->all(), $nowCompareValue);
            
            if ($validator->fails()) {
                throw new Exception($validator->errors());
            }

            // 현재 시간으로부터 10분 전의 시간을 구합니다.
            $currentTime = Carbon::now();
            $tenMinutesAgo = $currentTime->subMinutes(10);

            // 10분 전의 시간과 비교하여 몇 개인지 카운트
            $records = PhoneVerified::where('phone',$request->phone)->where('pv_send_time', '>=', $tenMinutesAgo)->count();

            // 10개 이상으로 요청오면 캐치
            if ($records > 10) {
                throw new Exception('휴대전화 인증은 10분에 10번까지만 가능합니다.  잠시 후에 다시 보내주세요');
            }

            // *이제 메세지 보내기
            // 유저한테서 이메일 주소를 받고 레코드 생성
            $pv_token = mt_rand(100000, 999999);
            PhoneVerified::create([
                'phone' => $request->email,
                'pv_token' => $pv_token,
            ]);

            // Vonage api 인스턴스
            $basic  = new Basic(env('VONAGE_API_KEY'), env('VONAGE_API_SECRET'));
            $client = new Client($basic);

            // 보낼대상과 우리 브랜드 이름(명시이름, 메세지에 안뜸)
            $TO_NUMBER = $request->phone;
            // $TO_NUMBER = "+8201091713466";
            $BRAND_NAME = "GoodsMarket";

            // // $text = new SMS(VONAGE_TO, VONAGE_FROM, 'Test message using PHP client library');
            // // $text->setClientRef('test-message');

            // 메세지
            // $text = 'hi im kkh, give me some food';
            $text = '굿즈마켓 인증번호: ['.$pv_token.']';

            // 메세지 담기
            $sms = new SMS(
                $TO_NUMBER, 
                $BRAND_NAME, 
                $text
            );

            // 한글은 번역해야함
            if (SMS::isGsm7($text)) {
                $sms->setType('text');
            } else {
                $sms->setType('unicode');
            }
            
            // 전송 ---------------------------------------------------
            // $response = $client->sms()->send($sms); // 돈 없음

            // 상태 반환
            // $message = $response->current();
            // if ($message->getStatus() == 0) {
                return response()->json(['message' => '문자를 송신하였습니다.']);
            // } else {
            //     throw new Exception('문자송신을 실패하였습니다.');
            // }
            // -------------------------------------------------------

            // // $data = $response->current();
            // // $data->getRemainingBalance();
            // // foreach($response as $index => $data){
            // //     $data->getRemainingBalance();
            // // }
            // // echo "Sent message to " . $data->getTo() . ". Balance is now " . $data->getRemainingBalance() . PHP_EOL;
        } catch (Exception $e) {
            // return false;
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    /**
     * 전화번호 & 토큰 체크
     *
     * @param  \Illuminate\Http\Request  $request
     * @return boolean
     */
    public function check(Request $request)
    {
        try {
            // 프론트에서는 5분 안에, 백엔드에서는 제한 없음

            $nowCompareValue = ["phone" => ValidatorList::$phone];

            // 유효성 검사
            $validator = Validator::make($request->all(), $nowCompareValue);
            
            if ($validator->fails()) {
                throw new Exception($validator->errors());
            }

            // 현재 시간으로부터 5분 전의 시간을 구합니다.
            $currentTime = Carbon::now();
            $tenMinutesAgo = $currentTime->subMinutes(5);

            // 이메일과 토큰을 받아서 레코드에 일치하는 게 있나 체크
            $emailVerified = EmailVerified::where('email', $request->email)
                ->where('token', $request->token)
                ->first();

            // 없으면 예외
            if(empty($emailVerified->all())){
                throw new Exception('토큰이 올바르지 않습니다.');
            }

            // 시간 만료 예외
            if($emailVerified->ev_send_time < $tenMinutesAgo){
                throw new Exception('만료된 토큰 입니다.');
            }

            return response()->json(['message' => '인증되었습니다.']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    /**
     * 임시, 이거 아니면 EmailVerified 컬럼 수정하고 그거 확인해서 검증
     *
     * @param  \Illuminate\Http\Request  $request
     * @return boolean
     */
    public function check_back(Request $request)
    {
        try {
            // 프론트에서는 5분 안에, 백엔드에서는 제한 없음

            $nowCompareValue = ["email" => "required|unique:users,u_email|email"];

            // 유효성 검사
            $validator = Validator::make($request->all(), $nowCompareValue);
            
            if ($validator->fails()) {
                throw new Exception($validator->errors());
            }

            // 이메일과 토큰을 받아서 레코드에 일치하는 게 있나 체크
            $emailVerified = EmailVerified::where('email', $request->email)
                ->where('token', $request->token)
                ->first();

            // 없으면 예외
            if(empty($emailVerified->all())){
                throw new Exception('토큰이 올바르지 않습니다.');
            }

            return response()->json(['message' => '인증되었습니다.']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    /**
     * SMS 발송
     * 
     * @param \Illuminate\Http\Response $request
     * $request = { phone:string , message:string } 
     * @return \Illuminate\Http\Response
     */
    public function send(Request $request)
    {
        
    }
}