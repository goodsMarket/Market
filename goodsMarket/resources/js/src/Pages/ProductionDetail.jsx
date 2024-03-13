import React, { useEffect } from 'react';
import axios from 'axios';
import { Helmet } from 'react-helmet';
import * as PortOne from "@portone/browser-sdk/v2";

function ProductionDetail() {
    // 결제 테스트
    useEffect(() => {
        // 결제 SDK 장착
        // const script = document.createElement('script');
        // script.src = 'https://cdn.portone.io/v2/browser-sdk.js';
        // script.async = true;
        // document.body.appendChild(script);

        return () => {
            // 언마운트 시 스크립트 제거
            // document.body.removeChild(script);
        };
    }, []); // 여기 배열에 있는 값이 바뀌면 useEffect 다시 호출 => 없으니 시작할 때 한번만 실행

    // Authorization 토큰
    const token = 'Bearer YOUR_TOKEN';

    // Axios 인스턴스 생성
    const instance = axios.create({
        baseURL: 'https://api.example.com',
        headers: {
            'Authorization': token
        }
    });

    // 결제 모듈 형식
    const portData = {
        // Store ID 설정
        storeId: 'store-9902f23f-c7a3-48d5-943b-23fb8eb28d69',
        // 채널 키 설정
        channelKey: 'channel-key-ff79c826-5ed4-441c-add3-71e9b51dcff3',
        paymentId: `payment-${crypto.randomUUID()}`,
        orderName: "나이키 와플 트레이너 2 SD",
        totalAmount: 1000,
        currency: "CURRENCY_KRW",
        payMethod: "CARD",
        // 모바일의 경우 redirect 해야한다고 함
        // redirectUrl: `${BASE_URL}/payment-redirect`,
    }

    PortOne.requestPayment(portData);
    
    const PayTest = () => {
        axios.post('/board/pay')
            .then(res => {
                console.log(res.data.message);
                return res.data.message;
            })
            .then(msg => {
                // 결제 모듈 호출
                // PortOne.requestPayment(portData);
            })
            // .then(response => {
            //     if (response.code != null) {
            //         // 오류 발생
            //         return alert(response.message);
            //     }
            // })
            // .then(()=>{
            //     // 결제 잘 됐는지 조회
            //     axios.patch('/pay', {
            //         paymentId: paymentId,
            //         // 주문 정보...
            //     })
            //     .then(response => {
            //         console.log(response.data);
            //     })
            //     .catch(error => {
            //         console.error(error);
            //     });
            // })
            .catch(err => {
                console.log(err.message);
            })
    }

    return (
        <div>
            <Helmet>
                {/* Content-Security-Policy 헤더 설정 */}
                <meta http-equiv="Content-Security-Policy" content="script-src 'self'" />

                {/* X-XSS-Protection 헤더 설정 */}
                <meta http-equiv="X-XSS-Protection" content="1; mode=block" />
            </Helmet>
            <h1>ProductionDetail</h1>

            <button onClick={PayTest}>구매</button>
        </div>
    )
}

export default ProductionDetail;