<?php

namespace App\Http\Controllers;

use App\Modules\MyRes;
use Exception;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function pay(Request $request){
        $message = [
            'store_id' => env('PAY_STORE_ID'),
            'channel_name' => env('PAY_CHANNEL_NAME'),
            'channel_key' => env('PAY_CHANNEL_KEY'),
            'mid' => env('PAY_MID'),
            'api_key' => env('PAY_API_KEY'),
            'v2_api_key' => env('PAY_V2_API_KEY'),
        ];

        return MyRes::res($message);
    }

    public function check(Request $request){
        // return 'test';
        // try {
        //     // 요청의 body로 paymentId가 오기를 기대합니다.
        //     // const { paymentId, order } = req.body;
        //     if(!$request->has('paymentId') || !$request->has('order')){
        //         throw new Exception('올바른 요청이 아닙니다.');
        //     }

        //     // 1. 포트원 결제내역 단건조회 API 호출
        //     const paymentResponse = await fetch(
        //     `https://api.portone.io/payments/${encodeURIComponent(paymentId)}`,
        //     {
        //         headers: { "Authorization": `PortOne ${PORTONE_API_SECRET}` },
        //     },
        //     );
        //     if (!paymentResponse.ok) throw new Error(`paymentResponse: ${paymentResponse.statusText}`);
        //     const payment = await paymentResponse.json();

        //     // 2. 고객사 내부 주문 데이터의 가격과 실제 지불된 금액을 비교합니다.
        //     const orderData = await OrderService.getOrderData(order);
        //     if (orderData.amount === payment.amount.total) {
        //     switch (payment.status) {
        //         case "VIRTUAL_ACCOUNT_ISSUED": {
        //         const paymentMethod = payment.paymentMethod;
        //         // 가상 계좌가 발급된 상태입니다.
        //         // 계좌 정보를 이용해 원하는 로직을 구성하세요.
        //         break;
        //         }
        //         case "PAID": {
        //         // 모든 금액을 지불했습니다! 완료 시 원하는 로직을 구성하세요.
        //         break;
        //         }
        //     }
        //     } else {
        //     // 결제 금액이 불일치하여 위/변조 시도가 의심됩니다.
        //     }

        // } catch (Exception $e) {
        //     return MyRes::err($e->getMessage());
        // }
    }
}
