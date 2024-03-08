import React from 'react';
import { BrowserRouter as Router, Link } from 'react-router-dom';

function Sidebar(props) {
    return (
      <section className='sidebar'>
        <div>
          <div className='sidebar-title'>거래 관리</div>
            <div className='sidebar-list'>
              <Link to='/'>판매 관리</Link>
              <Link to="/">구매 관리</Link>
              <Link to="/">리뷰 관리</Link>
              <Link to="/">출금 내역</Link>
            </div>
        </div>
        <div>
          <div className='sidebar-title'>계정 정보</div>
            <div className='sidebar-list'>
                <Link to="/">내 배송정보</Link>
                <Link to="/">개인통관고유번호</Link>
                <Link to="/">내 정보</Link>
                <Link to="/">로그아웃</Link>
            </div>
        </div>
      </section>
    );
}

export default Sidebar;