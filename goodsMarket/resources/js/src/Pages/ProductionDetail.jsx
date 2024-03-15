import React, { useEffect } from 'react';
import axios from 'axios';
import { Helmet } from 'react-helmet';
// import * as PortOne from "@portone/browser-sdk/v2";
import * as Pay from '../Module/Payment';

function ProductionDetail() {
    useEffect(() => {
        // 결제 SDK 장착
        const loadScripts = async () => {
            try {
                await Promise.all([
                    Pay.loadScript('https://cdn.iamport.kr/v1/iamport.js'),
                    Pay.loadScript('https://code.jquery.com/jquery-1.12.4.min.js', 'text/javascript'),
                    Pay.loadScript('https://cdn.iamport.kr/js/iamport.payment-1.2.0.js', 'text/javascript'),
                ]);
            } catch (error) {
                console.error('Error loading scripts:', error);
            }
        };

        loadScripts();
        return () => {
            // 언마운트 시 스크립트 제거
            Pay.removeScript();
        };
    }, []); // 여기 배열에 있는 값이 바뀌면 useEffect 다시 호출 => 없으니 시작할 때 한번만 실행

    // 결제 호출 버튼
    const PayTest = () => {
        axios.post('/board/pay')
            .then(res => {
                console.log(res.data.message);
                return res.data.message;
            })
            .then(msg => {
                if (confirm("구매 하시겠습니까?")) { // 구매 클릭시 한번 더 확인하기
                    if (true) { // localStorage.getItem("access")) { // 회원만 결제 가능
                        // 전달 데이터 수정
                        Pay.PayForm.pg = msg.pg_name;
                        Pay.PayForm.pay_method = msg.method, // 결제 방식 'card'
                        // Pay.PayForm.name = msg.item_name, // 제품명
                        // amount: 0, // 가격
                        // //구매자 정보 ↓
                        // buyer_email: '', // `${useremail}`
                        // buyer_name: '', // `${username}`
                        // // 안필요 ↓
                        // buyer_tel : '', // '010-1234-5678'
                        // buyer_addr : '', // '서울특별시 강남구 삼성동'
                        // buyer_postcode : '' // '123-456'

                        // 구매 요청
                        Pay.Payment(imp, 'production');
                    }
                    else { // 비회원 결제 불가
                        alert('로그인이 필요합니다!')
                    }
                } else { // 구매 확인 알림창 취소 클릭시 돌아가기
                    return false;
                }
            })
            .catch(err => {
                console.log(err.message);
            })
    }

    // {/* Content-Security-Policy 헤더 설정 */}
    // <meta http-equiv="Content-Security-Policy" content="script-src 'self'" />

    return (
        <div>
            <Helmet>
                {/* X-XSS-Protection 헤더 설정 */}
                <meta http-equiv="X-XSS-Protection" content="1; mode=block" />
            </Helmet>
            <h1>ProductionDetail</h1>

            <button onClick={PayTest}>구매</button>
        </div>
    )
}

export default ProductionDetail;