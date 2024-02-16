import React, { useState } from 'react';
import { Link } from "react-router-dom";



function Login(props) {
	const [u_email, setU_email] = useState('');
	const [u_pw, setU_pw] = useState('');
	
	const handleChangeEmail = (event) => {
		setU_email(event.target.u_email);
	}
	const handleChangePassword = (event) => {
		setU_pw(event.target.u_pw);
	}

	const handleSubmit = (event) => {
		console.log(event);
		alert(event);
	}
    return (
		<form onSubmit={handleSubmit}>
			<span>로그인</span>
			<br />
			<input type="email" onChange={handleChangeEmail} name='u_email' placeholder='example@example.com' />
			<br />
			<input type="password" onChange={handleChangePassword} name='u_pw' placeholder='password' />
			<br />
			<Link to ="#">이메일 찾기 / 비밀번호 찾기</Link>
			<button type='submit'>로그인</button>
		</form>
    );
}
export default Login;