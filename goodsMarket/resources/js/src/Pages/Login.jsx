import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { Link } from 'react-router-dom';
import '/css/user.css';
import Button from "../Components/Button";


function Login(props) {

    // useEffect(() => {
    //     // Axios로 서버에 요청을 보내고 응답을 받은 후에 쿠키 값을 확인
    //     // 해당 요청을 보내는 부분에 대한 코드를 작성하세요
    //     // 응답에서 쿠키 값을 가져오는 방법은 서버에서 응답 헤더를 확인하거나,
    //     // 클라이언트에서 document.cookie를 사용하여 쿠키를 가져올 수 있습니다.
    //     // 가져온 쿠키 값은 setCookieValue 함수를 사용하여 상태에 저장합니다.
    // }, []);
    
    const [form, setForm] = useState({
        u_email: '',
        u_pw: ''
    });

    const registBtn = {
        width: "200px",
        height: "60px"
    }
	// const navigate = useNavigate(); navigate('/home')

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
            console.log(response);
            if(response.data) {
                // console.log('성공!');
                setErrorShow(false);
            } else {
                setErrorShow(true);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    };

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