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
		ev_token: '',
		u_phone_num: '',
		pv_token: '',
    });
	
	const onChange = (e) => {
		const { name, value } = e.target;
		if (name === 'u_agree_flg') {
			setForm({
				...form,
				[name]: '1', // 라디오 버튼이 선택되면 값을 '1'로 설정
			});
		} else {
			setForm({
				...form,
				[name]: value,
			});
		}
    };
	// 이메일 보내기
	const emailSend = (e) => {
		e.preventDefault();
		if (form.u_email === '') {
			alert('이메일을 입력해주세요.');
			return false;
		}
		const { u_email } = form;
		axios.post('/regist/mail', { u_email })
        .then(response => {
			startCountdown();
			console.log(response);
			if(response.data.errors) {
				console.log('실패');
				const array = response.data.errors;
				errorSetting(array);
			} else {
				setErrorU_email(false);
				setForm(prevState => ({
					...prevState, // 이전 상태 복사
					u_email: u_email, // 새로운 u_email 값 설정
				}));
			}
        })
        .catch(error => {
            console.error('Error:', error);
		})
	}
	// 인증코드 확인
	const emailVerification = (e) => {
		e.preventDefault();
		if (form.ev_token === '') {
			alert('인증코드를 입력해주세요.');
			return false;
		}
		// setemaildisabled(prevState => !prevState);
		try {
			// ev_token만 전송
			const { u_email, ev_token } = form;
			axios.post('/regist/mail/check', { u_email, ev_token })
			.then(response => {
				console.log(response.data);
				if( response.data === 'message' ) {
					setForm(prevState => ({
						...prevState, // 이전 상태 복사
						ev_token: ev_token,
					}));
					alert('인증이 완료되었습니다.');
					// setemaildisabled(prevState => !prevState);
				} else if ( response.data === 'error' ) {
	
				}
			})
			.catch(error => {
				console.error('Error:', error);
			})
		} catch (error) {

		}
	}
	// 닉네임 중복 확인
	const nickNameChk = (e) => {
		e.preventDefault();
		try {
			const { u_nickname } = form;
			axios.post('/regist/part', { u_nickname })
			.then(response => {
				console.log(response.data);
				setForm(prevState => ({
					...prevState, // 이전 상태 복사
					u_nickname: u_nickname,
				}));
				// 메세지 알림 처리
			})
			.catch(error => {
				console.error('Error:', error);
			})
		} catch (error) {
			console.error('Error:', error);
		}
		
	}
	// 전화번호 확인
	const phoneNumber = (e) => {
		e.preventDefault();
		try {
			const { u_phone_num } = form;
			console.log(u_phone_num);
			axios.post('/regist/sms', { u_phone_num })
			.then(response => {
				startCountdown2();
				console.log(response.data);
				setForm(prevState => ({
					...prevState, // 이전 상태 복사
					u_phone_num: u_phone_num,
				}));
				// 메세지 알림 처리
			})
			.catch(error => {
				console.error('Error:', error);
			})
		} catch (error) {
			console.error('Error:', error);
		}
	}

	// 전화번호 인증코드 확인
	const phoneVerification = (e) => {
		e.preventDefault();
		try {
			const { u_phone_num, pv_token } = form;
			console.log(pv_token);
			axios.post('/regist/sms/check', { u_phone_num, pv_token })
			.then(response => {
				console.log(response.data);
				setForm(prevState => ({
					...prevState, // 이전 상태 복사
					pv_token: pv_token,
				}));
				// 메세지 알림 처리
			})
			.catch(error => {
				console.error('Error:', error);
			})
		} catch (error) {
			console.error('Error:', error);
		}
	};

	const [minutes, setMinutes] = useState('');
	const [seconds, setSeconds] = useState('');
	const [minutes2, setMinutes2] = useState('');
	const [seconds2, setSeconds2] = useState('');
	

	const [emailInterval, setEmailInterval] = useState(null);
	const [phoneinterval, setPhoneinterval] = useState(null);

	const emailCounter = () => {
		clearInterval(emailInterval);
		const newIntervalId = setInterval(() => {
			if (seconds === 0) {
				if (minutes === 0) {
					clearInterval(newIntervalId);
					// 카운트다운이 종료되었을 때 처리
					
				} else {
					setMinutes(prevMinutes => prevMinutes - 1);
					setSeconds(59);
				}
			} else {
				setSeconds(prevSeconds => prevSeconds - 1);
			}
		}, 1000);
		setEmailInterval(newIntervalId); // 새로운 intervalId1 설정
	};

	const phoneCounter = () => {
		clearInterval(phoneinterval);
		const newIntervalId = setInterval(() => {
			if (seconds2 === 0) {
				if (minutes2 === 0) {
					clearInterval(newIntervalId);
					// 카운트다운이 종료되었을 때 처리
					
				} else {
					setMinutes2(prevMinutes => prevMinutes - 1);
					setSeconds2(59);
				}
			} else {
				setSeconds2(prevSeconds => prevSeconds - 1);
			}
		}, 1000);
		setPhoneinterval(newIntervalId); 
	};


	useEffect(() => {
		setShow();
		emailCounter();
		phoneCounter();
		// const intervalId = setInterval(() => {
		// 	if (seconds === 0) {
		// 		if (minutes === 0) {
		// 			clearInterval(intervalId);
		// 			// 카운트다운이 종료되었을 때 처리
					
		// 		} else {
		// 			setMinutes(prevMinutes => prevMinutes - 1);
		// 			setSeconds(59);
		// 		}
		// 	} else {
		// 		setSeconds(prevSeconds => prevSeconds - 1);
		// 	}
		// }, 1000);
		// return () => clearInterval(intervalId);

		// const phoneVerificationCounter = setInterval(() => {
		// 	if (seconds === 0) {
		// 		if (minutes === 0) {
		// 			clearInterval(intervalId);
		// 			// 카운트다운이 종료되었을 때 처리
					
		// 		} else {
		// 			setMinutes(prevMinutes => prevMinutes - 1);
		// 			setSeconds(59);
		// 		}
		// 	} else {
		// 		setSeconds(prevSeconds => prevSeconds - 1);
		// 	}
		// }, 1000);
		// return () => clearInterval(intervalId);

	}, [minutes, seconds, minutes2, seconds2, emailInterval, phoneinterval]);

	const startCountdown = () => {
		setMinutes(5); // 카운트다운을 5분으로 설정
		setSeconds(0); // 초를 초기화
	};
	const startCountdown2 = () => {
		setMinutes2(5); // 카운트다운을 5분으로 설정
		setSeconds2(0); // 초를 초기화
	};
	const setShow = () => {
		if(form.u_agree_flg === '1' ) {
			const secondSection = document.querySelector('.regist-second-section');
            if (secondSection) {
                secondSection.classList.remove('display-none');
				secondSection.classList.add('display-grid');
            }
			const firstSection = document.querySelector('.regist-first-section');
			if (firstSection) {
				firstSection.classList.add('display-none');
            }
		}
	}

	const [errormsg, setErrormsg] = useState({
		u_email: '',
		u_name: '',
		u_nickname:	'',
		u_pw: '',
		u_pw_confirmation: '',
		ev_token: '',
		u_phone_num: '',
		pv_token: '',
	});

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
			errorSetting(response.data.errors);
			// console.log(response.data.error["u_email"]);
			// if(response.data.error.u_email) {
			// 	setErrorU_email(true);
			// 	console.log('u_email에러떴음');
			// 	setEmailError(response.data.error.u_email);
			// }
        })
        .catch(error => {
            console.error('Error:', error);
		})
    };

	function errorSetting (array) {
		for (const key in array) {
			if (Object.hasOwnProperty.call(array, key)) {
				console.log(`Key: ${key}`);
				const valueArray = array[key];
				valueArray.forEach((errorMessage) => {
					console.log(`errorMessage: ${errorMessage}`);
					// console.log(`Error: ${errorMessage}`);
					errorShowSet(key, errorMessage);
				});
			}
		}
	}
	function errorShowSet (key, errorMessage) {
		console.log('errorShowSet 호출');
		// const name = key;
		// const value = errorMessage;
		setErrormsg({
			...errormsg,
			[key]: errorMessage,
		});
	}


    return (
		<div className='form-main'>
			<section className='regist-first-section'>
			<h2 className='regist-form-title'>회원가입</h2>
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
					<input type="radio" onChange={onChange} id="agreement" name="u_agree_flg" value={form.u_agree_flg}/>
					<label htmlFor="agreement" className='regist-agreement-txt'>이용약관 동의 (필수)</label>
				</div>
			</section>
			<section className='regist-second-section display-none'>
			<h2 className='regist-form-title'>회원가입</h2>
				<div>
					<form onSubmit={emailSend}>
						<input type="text" name='u_email' onChange={onChange} placeholder='이메일을 입력해주세요.' />
						<div className='regist-setBtn'>
							<span className='regist-second-err'>{errormsg.u_email}</span>
							<Button type="submit">인증하기</Button>
						</div>
					</form>
				</div>
				<div>
					<form onSubmit={emailVerification} className='regist-certification-form'>
						<input type="text" onChange={onChange} name='ev_token' value={form.ev_token} placeholder='인증코드를 입력해주세요.'/>
						{ minutes !== '' && seconds !== '' && (
						<span className='regist-countdown-span'>{`${minutes.toString()}:${seconds.toString().padStart(2, '0')}`}</span>
						)}
						<span className='regist-second-err'>{errormsg.ev_token}</span>
						<button type="submit" className='regist-certification'>코드 확인</button>
					</form>
				</div>
				<div>
					<input type="text" name='u_name' onChange={onChange} value={form.u_name} placeholder='이름을 입력해주세요.' />
					<span className='regist-second-err'>{errormsg.u_name}</span>
				</div>
				<div>
					<form onSubmit={nickNameChk} className='regist-certification-form'>
						<input type="text" name='u_nickname' onChange={onChange} value={form.u_nickname} placeholder='닉네임을 입력해주세요.' />
						<span className='regist-second-err'>{errormsg.u_nickname}</span>
						<button type="submit" className='regist-certification'>중복 확인</button>
					</form>
				</div>
				<div>
					<input type="password" name='u_pw' onChange={onChange} value={form.u_pw} placeholder='비밀번호를 입력해주세요.' />
					<span className='regist-second-err'>{errormsg.u_pw}</span>
				</div>
				<div>
					<input type="password" name='u_pw_confirmation' onChange={onChange} value={form.u_pw_confirmation} placeholder='비밀번호 확인' />
					<span className='regist-second-err'>{errormsg.u_pw_confirmation}</span>
				</div>
				<div>
					<form onSubmit={phoneNumber}>
						<input type="text" name='u_phone_num' onChange={onChange} value={form.u_phone_num} placeholder='전화번호를 입력해주세요.' />
						<div className='regist-setBtn'>
						<span className='regist-second-err'>{errormsg.u_phone_num}</span>
							<Button type="submit">인증하기</Button>
						</div>
					</form>
				</div>
				<div>
					<form onSubmit={phoneVerification} className='regist-certification-form'>
						<input type="text" onChange={onChange} name='pv_token' value={form.pv_token} placeholder='인증코드를 입력해주세요.' />
						{ minutes2 !== '' && seconds2 !== '' && (
						<span className='regist-countdown-span'>{`${minutes2.toString()}:${seconds2.toString().padStart(2, '0')}`}</span>
						)}
						<span className='regist-second-err'>{errormsg.pv_token}</span>
						<button type="submit" className='regist-certification'>코드 확인</button>
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