import React, { useState } from 'react';
import Button from "../Components/Button";

function Regist() {

	const [form, setForm] = useState({
        u_agree_flg: '',
    });

	const submit = (e) => {
        e.preventDefault();
        history.push('/abcd');
    };
	
    const regist = (e) => {
        const { name, value } = e.target;
        setForm({
            ...form,
            [name]: value,
        });
        console.log(e);
    };

    return (
		<div className='form-main'>
            <form onSubmit={submit} className='regist-form-section'>
				<h1 className='regist-form-title'>회원가입</h1>
				<section className='regist-first-section'>
					<div>
						<div className='form-box'>
							<h3>이용약관 및 개인정보처리방침</h3>
							<br />
							본인은 귀사에 이력서를 제출함에 따라 [개인정보 보호법] 제15조 및 제17조에 따라 아래의 내용으로 개인정보를 수집, 이용 및 제공하는데 동의합니다.
							<br /><br />
							□ 개인정보의 수집 및 이용에 관한 사항<br />
							- 수집하는 개인정보 항목 (이력서 양식 내용 일체) : 성명, 주민등록번호, 전화번호, 
							주소, 이메일, 가족관계, 학력사항, 경력사항, 자격사항 등과 그 外 이력서 기재 내용 
							일체<br />
							- 개인정보의 이용 목적 : 수집된 개인정보를 사업장 신규 채용 서류 심사 및 인사서
							류로 활용하며, 목적 외의 용도로는 사용하지 않습니다. <br />
							<br />
							□ 개인정보의 보관 및 이용 기간<br />
							- 귀하의 개인정보를 다음과 같이 보관하며, 수집, 이용 및 제공목적이 달성된 경우 
							[개인정보 보호법] 제21조에 따라 처리합니다.
						</div>
						<br />
						<input type="radio" onChange={regist} id="agreement" name='u_agree_flg' value="1"/>
						<label htmlFor="agreement" className='regist-agreement-txt'>이용약관 동의 (필수)</label>
					</div>
				</section>
				<section className='regist-second-section'>

				</section>
			</form>
        </div>
    );
}

export default Regist;