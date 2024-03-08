import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { Link, useNavigate, useNavigationType  } from 'react-router-dom';
import '/css/user.css';
import Button from "../Components/Button";
import {useCookies} from 'react-cookie'


function Login(props) {

    const [form, setForm] = useState({
        u_email: '',
        u_pw: ''
    });

    const registBtn = {
        width: "200px",
        height: "60px"
    }

    const onChange = (e) => {
        const { name, value } = e.target;
        setForm({
            ...form,
            [name]: value,
        });
    };
    const [errorShow, setErrorShow] = useState(false);
    const errortxt = '아이디 및 비밀번호를 다시 확인해주세요.';
    useEffect(() => {

    }, [errorShow]);

    const submit = (e) => {
        e.preventDefault();
        console.log(form);
        axios.post('/login', form)
        .then(response => {
            if (response.data === false) {
                setErrorShow(true);
            } else {
                setErrorShow(false);
                login();
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    };
	const navigate = useNavigate();
    const navigationType = useNavigationType();

  	function login() { // 로그인하게 되면
    	if(navigationType === "PUSH") navigate(-1); // redirect로 왔다면 이전 페이지로
        else navigate("/"); // 홈으로
    }

    function cookieset() {

        // const cookies = document.cookie.split('; ').reduce((prev, current) => {
        //     const [name, value] = current.split('=');
        //     if (name === 'user_id') {
        //         prev[name] = value;
        //     }
        //     return prev;
        // }, {});
        // // const userId = cookies.user_id;

    }
    const onKeyPress = (e) => {
        if (e.key === 'Enter') {
            submit();
        }
    };

    return (
        <div className='form-main'>
            <form onSubmit={submit} className='form-box'>
                <h1 className='form-title'>로그인</h1>
                <br />
                <span className='login-errormsg'>
                    {errorShow ? (<div>{errortxt}</div>) : null}
                </span>
                <input type="email" onChange={onChange} value={form.u_email} name='u_email' placeholder='example@example.com' />
                <br />
                <input type="password" onChange={onChange} value={form.u_pw} name='u_pw' placeholder='password' onKeyPress={onKeyPress} />
                <br />
                <div className='form-button'>
                    <Link to="#">이메일 찾기 / 비밀번호 찾기</Link>
                    <Button type="submit">로그인</Button>
                </div>
            </form>
            <div className='login-regist-button'>
                <div className='login-api'>
                    <img src="/img/kakao_login.png" alt="" />
                    <br />
                    <img src="/img/naver_login.png" alt="" />
                </div>
                <div className='login-vertical-line'>
                <br /><br /><br /><br />
                </div>
                <div>
                    <Link to='/regist'>
                    <Button type="button" style={registBtn}>회원가입</Button>
                    </Link>
                </div>
            </div>
        </div>
    );
}

export default Login;