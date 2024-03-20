import axios from 'axios';

/**
 * SDK 스크립트 불러오기
 * @param {string} src 
 * @param {string} type 
 * @param {boolean} async 
 * @returns {Promise}
 */
export const loadScript = (src, type = '', async = false) => {
    return new Promise((resolve, reject) => {
        const script = document.createElement('script');
        script.async = async;
        script.type = type;
        script.src = src;
        script.onload = resolve;
        script.onerror = reject;
        document.head.appendChild(script);
    });
};

/**
 * 스크립트 삭제 메소드
 */
export const removeScript = () => {
    const scripts = document.head.querySelectorAll('script')
    for (let i = 0; i < scripts.length; i++) {
        const script = document.head.querySelector('script')
        document.head.removeChild(script);
    }
}


/**
 *  구매자 정보
 */
const useremail = 'goods.market.project@gmail.com'
const username = 'GoodsMarket'

/**
 * 결제고유번호 => IMP.request_pay({merchant_uid})
 */
const today = new Date();
const hours = today.getHours(); // 시
const minutes = today.getMinutes();  // 분
const seconds = today.getSeconds();  // 초
const milliseconds = today.getMilliseconds();
export const makeMerchantUid = `${hours}` + `${minutes}` + `${seconds}` + `${milliseconds}`;

/**
 * 결제 요구 데이터 형식
 */
export const PayForm = {
    pg: '', // PG사 코드표에서 선택 'html5_inicis.INIpayTest'
    pay_method: '', // 결제 방식 'card'
    merchant_uid: "IMP" + makeMerchantUid, // 결제 고유 번호
    name: '', // 제품명
    amount: 0, // 가격
    //구매자 정보 ↓
    buyer_email: '', // `${useremail}`
    buyer_name: '', // `${username}`
    // 안필요 ↓
    buyer_tel: '', // '010-1234-5678'
    buyer_addr: '', // '서울특별시 강남구 삼성동'
    buyer_postcode: '' // '123-456'
}

/**
 * 결제 모듈
 * @param {string} imp 가맹점 번호
 * @param {string} boardType 보드타입
*/

export const Payment = (imp, boardType) => {
    var IMP = window.IMP;

    IMP.init(imp); // 가맹점 식별코드 "imp14001070"
    IMP.request_pay(PayForm, async function (rsp) { // callback
        if (rsp.success) { //결제 성공시
            console.log(rsp);
            //결제 성공시 프로젝트 DB저장 요청
            axios.post('/receipt/' + boardType)
                .then(response => {
                    if (response.status == 200) { // DB저장 성공시
                        alert('결제 완료!')
                        window.location.reload();
                    } else { // 결제완료 후 DB저장 실패시
                        alert(`error:[${response.status}]\n결제요청이 승인된 경우 관리자에게 문의바랍니다.`);
                        // DB저장 실패시 status에 따라 추가적인 작업 가능성
                    }
                })
                .catch(error => {
                    console.log(error.stack);
                });
        } else if (rsp.success == false) { // 결제 실패시
            alert(rsp.error_msg)
        }
    });
}

/**
 * 구매 버튼 함수 모듈화
 */
export const PayButton = () => {
    axios.post('/board/pay')
        .then(res => {
            console.log(res);
            if (confirm("구매 하시겠습니까?")) { // 구매 클릭시 한번 더 확인하기
                if (res.data?.message) {
                    const msg = res.data.message;
                    // --- 전달 데이터 수정 ---
                    // 필수
                    Pay.PayForm.pg = msg.pg_name;
                    Pay.PayForm.pay_method = msg.method; // 결제 방식 'card'
                    Pay.PayForm.name = 'test테스트'; // 제품명 *한글 없으면 오류 with KG이니시스
                    Pay.PayForm.amount = 1000; // 가격
                    // 필수 구매자 정보 ↓
                    Pay.PayForm.buyer_email = ''; // `${useremail}`
                    Pay.PayForm.buyer_name = ''; // `${username}`
                    // 안필요 ↓
                    Pay.PayForm.buyer_tel = ''; // '010-1234-5678'
                    Pay.PayForm.buyer_addr = ''; // '서울특별시 강남구 삼성동'
                    Pay.PayForm.buyer_postcode = ''; // '123-456'

                    // 구매 요청
                    Pay.Payment(msg.imp, 'used_trade');
                }
                else { // 비회원 결제 불가
                    alert('로그인이 필요합니다!')
                }
            } else { // 구매 확인 알림창 취소 클릭시 돌아가기
                console.log(res.data.error);
                return false;
            }
        })
        .catch(err => {
            console.log(err.message);
        })
}