import React, { useState, useEffect } from 'react';
import Button from "../Components/Button";
import '/css/user.css';
import axios from 'axios';

function Regist() {

	const [form, setForm] = useState({
        u_agree_flg: '',
		u_email: '',
		u_name: '',
		u_nickname:	'',
		u_pw: '',
		u_pw_confirmation: '',
		u_phone_num: '',
		token: '',
		u_phone_num_chk: '',
    });
	// 이메일 input disabled
	const [emaildisabled, setemaildisabled] = useState(false);
	
	const onChange = (e) => {
		const { name, value } = e.target;
		// axios.post('/mail', form)
        // .then(response => {
        //     console.log(response.data);
        // })
        // .catch(error => {
        //     console.error('Error:', error);
		// })
        setForm({
			...form,
            [name]: value,
        });
    };
	// 이메일 보내기
	const emailSend = (e) => {
		e.preventDefault();
		if (form.u_email === '') {
			alert('이메일을 입력해주세요.');
			return false;
		}
		startCountdown();

		// axios.post('/mail', form)
        // .then(response => {
        //     console.log(response.data);
        // })
        // .catch(error => {
        //     console.error('Error:', error);
		// })
	}
	// 인증코드 확인
	const emailVerification = (e) => {
		e.preventDefault();
		console.log(e);
		if (form.token === '') {
			alert('인증코드를 입력해주세요.');
			return false;
		}
		setemaildisabled(prevState => !prevState);
		// try {
		// 	// token만 전송
		// 	const { u_email, token } = form;
		// 	const response = axios.post('/mail/check', { u_email, token });
		// 	console.log(response.data);
		// 	if( response.data === 'message' ) {
		// 		setForm({
		// 			token: token,
		// 		});
		// 		alert('인증이 완료되었습니다.');
		// 		setemaildisabled(prevState => !prevState);
		// 	} else if ( response.data === 'error' ) {

		// 	}

		// } catch (error) {
		// 	console.error('Error:', error);
		// }
	}
	// 닉네임 중복 확인
	const nickNameChk = (e) => {
		e.preventDefault();
		try {
			const { u_nickname } = form;
			const response = axios.post('/', { u_nickname });
			console.log(response.data);
		} catch (error) {
			console.error('Error:', error);
		}
		
	}
	// 전화번호 확인
	const phoneNumber = (e) => {
		e.preventDefault();
		console.log(e);
	}

	// 전화번호 인증코드 확인
	const phoneVerification = (e) => {
		e.preventDefault();
		console.log(e);
	};

	const [minutes, setMinutes] = useState('');
	const [seconds, setSeconds] = useState('');
	
	useEffect(() => {
		const intervalId = setInterval(() => {
			if (seconds === 0) {
				if (minutes === 0) {
					clearInterval(intervalId);
					// 카운트다운이 종료되었을 때 처리
					
				} else {
					setMinutes(prevMinutes => prevMinutes - 1);
					setSeconds(59);
				}
			} else {
				setSeconds(prevSeconds => prevSeconds - 1);
			}
		}, 1000);
		return () => clearInterval(intervalId);
	}, [minutes, seconds]);

	const startCountdown = () => {
		setMinutes(5); // 카운트다운을 5분으로 설정
		setSeconds(0); // 초를 초기화
	};
	const setShow = () => {
		if(form.u_agree_flg === '1' ) {
			const block = document.querySelector('.regist-second-section');
            if (block) {
                block.classList.remove('display-none');
				block.classList.add('display-block');
            }
		} else {
			const block = document.querySelector('.regist-second-section');
            if (block) {
                block.classList.add('display-none');
            }
		}
	}
	const submit = (e) => {
		e.preventDefault();
		if(form.u_agree_flg === '') {
			alert('이용약관은 필수 동의사항입니다.');
			return false;
		} else if (form.u_email === '') {
			alert('이메일 인증을 진행해주세요.');
			return false;
		} else if (form.u_name === '') {
			alert('이름은 필수 입력사항입니다.');
			return false;
		} else if (form.u_nickname === '') {
			alert('닉네임은 필수 입력사항입니다.');
			return false;
		} else if (form.u_pw === '') {
			alert('비밀번호는 필수 입력사항입니다.');
			return false;
		} else if (form.u_pw_confirmation === '') {
			alert('비밀번호 확인을 입력해주세요.');
			return false;
		} else if (form.u_phone_num === '') {
			alert('번호 인증을 진행해주세요.');
			return false;
		}
		axios.post('/regist', form)
        .then(response => {
            console.log(response.data);
        })
        .catch(error => {
            console.error('Error:', error);
		})
    };


    return (
		<div className='form-main'>
			<h2 className='regist-form-title'>회원가입</h2>
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
					<input type="radio" onChange={onChange} id="agreement" name="u_agree_flg" value="1"/>
					<label htmlFor="agreement" className='regist-agreement-txt'>이용약관 동의 (필수)</label>
				</div>
			</section>
			<section className='regist-second-section {setShow}'>
			<h2 className='regist-form-title'>회원가입</h2>
				<div>
					<form onSubmit={emailSend}>
						<input type="email" name='u_email' onChange={onChange} placeholder='이메일을 입력해주세요.' />
						<div className='regist-setBtn'>
							<span className='regist-second-err'>에러메세지</span>
							<Button type="submit">인증하기</Button>
						</div>
					</form>
				</div>
				<div>
					<form onSubmit={emailVerification} className='regist-certification-form'>
						<input type="text" onChange={onChange} name='token' value={form.token} placeholder='인증코드를 입력해주세요.' disabled={emaildisabled} />
						{ minutes !== '' && seconds !== '' && (
						<span className='regist-countdown-span'>{`${minutes.toString()}:${seconds.toString().padStart(2, '0')}`}</span>
						)}
						<span className='regist-second-err'>에러메세지</span>
						<button type="button" className='regist-certification'>코드 확인</button>
					</form>
				</div>
				<div>
					<input type="text" name='u_name' onChange={onChange} value={form.u_name} placeholder='이름을 입력해주세요.' />
					<span className='regist-second-err'>에러메세지</span>
				</div>
				<div>
					<form onSubmit={nickNameChk} className='regist-certification-form'>
						<input type="text" name='u_nickname' onChange={onChange} value={form.u_nickname} placeholder='닉네임을 입력해주세요.' />
						<span className='regist-second-err'>에러메세지</span>
						<button type="button" className='regist-certification'>중복 확인</button>
					</form>
				</div>
				<div>
					<input type="password" name='u_pw' onChange={onChange} value={form.u_pw} placeholder='비밀번호를 입력해주세요.' />
					<span className='regist-second-err'>에러메세지</span>
				</div>
				<div>
					<input type="password" name='u_pw_confirmation' onChange={onChange} value={form.u_pw_confirmation} placeholder='비밀번호 확인' />
					<span className='regist-second-err'>에러메세지</span>
				</div>
				<div>
					<form onSubmit={phoneNumber}>
						<input type="text" name='u_phone_num' onChange={onChange} value={form.u_phone_num} placeholder='전화번호를 입력해주세요.' />
						<div className='regist-setBtn'>
							<span className='regist-second-err'>에러메세지</span>
							<Button type="button">인증하기</Button>
						</div>
					</form>
				</div>
				<div>
					<form onSubmit={phoneVerification} className='regist-certification-form'>
						<input type="text" onChange={onChange} placeholder='인증코드를 입력해주세요.' />
						<span className='regist-countdown-span'>00:00</span>
						<span className='regist-second-err'>에러메세지</span>
						<button type="button" className='regist-certification'>코드 확인</button>
					</form>
				</div>
			<br /><br />
			<form onSubmit={submit} className='regist-form-section'>
				<Button type="submit">회원가입</Button>
			</form>
			<br /><br />
			</section>
        </div>
    );
}

export default Regist;