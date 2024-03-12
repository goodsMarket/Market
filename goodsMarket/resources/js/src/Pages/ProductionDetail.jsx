import React, { useEffect } from 'react';
import axios from 'axios';

function ProductionDetail() {
    // 결제 테스트
    useEffect(() => {
        const script = document.createElement('script');
        script.src = 'https://cdn.iamport.kr/v1/iamport.js';
        script.async = true;
        document.body.appendChild(script);

        return () => {
            // 언마운트 시 스크립트 제거
            document.body.removeChild(script);
        };
    }, []); // 여기 배열에 있는 값이 바뀌면 useEffect 호출 => 없으니 시작할 때만 실행

    const PayTest = () => {
        axios.post('/pay')
            .then(res => {
                console.log(res);
            })
            .catch(err => {
                console.log(err.stack);
            })
    }

    return (
        <div>
            <h1>ProductionDetail</h1>

            <button onClick={PayTest}>구매</button>
        </div>
    )
}

export default ProductionDetail;