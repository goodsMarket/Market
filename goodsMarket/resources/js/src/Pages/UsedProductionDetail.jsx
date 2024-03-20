import React, { useEffect, memo } from 'react';
import axios from 'axios';
import { Helmet } from 'react-helmet';
// import * as PortOne from "@portone/browser-sdk/v2";
import * as Pay from '../Module/Payment';
import '/css/components/main-field.css';

function ProductionDetail() {
    useEffect(() => {
        // 결제 SDK 장착
        Pay.loadScript('https://cdn.iamport.kr/v1/iamport.js')
        Pay.loadScript('https://code.jquery.com/jquery-1.12.4.min.js', 'text/javascript')
        Pay.loadScript('https://cdn.iamport.kr/js/iamport.payment-1.2.0.js', 'text/javascript')
        return () => {
            // 언마운트 시 스크립트 제거
            Pay.removeScript();
        };
    }, []);

    useEffect(() => {
        // 받아온 id값으로 patch요청
        const boardId = window.location.href.match(/id=(\d+)/)[1];

        axios.patch('/board/used-trade',{
            id: boardId,
        })
            .then(res => {
                console.log(res?.data?.message);
            })
            .catch(err => {
                console.log(err.stack);
            })
    }, []);

    return (
        <div className='productionbox-grid main-field'>
            <Helmet>
                {/* X-XSS-Protection 헤더 설정 */}
                <meta http-equiv="X-XSS-Protection" content="1; mode=block" />
            </Helmet>
            <h1>UsedProductionDetail</h1>

            <button onClick={Pay.PayButton}>구매</button>
        </div>
    )
}

export default memo(ProductionDetail);