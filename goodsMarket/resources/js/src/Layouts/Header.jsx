import React, { useState } from 'react';
import { BrowserRouter as Router, Link } from 'react-router-dom';
import '/css/common.css';

function Header(props) {

	const [isVisible, setIsVisible] = useState(false);
	const [category, setcategory] = useState(false);
	const [searchList, setsearchList] = useState(false);
	
	const showInsert = () => {
		setIsVisible(!isVisible);
		setcategory(false);
		setsearchList(false);
	};
	const showCategories = () => {
		setcategory(!category);
		setIsVisible(false);
		setsearchList(false);
	};
	const showSearchSet = () => {
		setsearchList(!searchList);
		setIsVisible(false);
		setcategory(false);
	};
	const displayFlex = searchList ? 'header-search-list' : 'display-none';
	const iconRotate = searchList ? 'header-seacrh-list-bar header-seacrh-list-bar-rotated' : 'header-seacrh-list-bar';
	const categoryBlock = category ? 'header-category-list' : 'display-none';
	const headerMypage = isVisible ? 'header-list display-flex' : 'display-none';
	
	const [searchListset, setSearchListset] = useState('전체');

	const setSearchList = (e) => {
		const value = e.target.textContent;
		setSearchListset(value);
		setsearchList(!searchList);
	};

		const [categoryOption, setCategoryOption] = useState('');
		const [categoryOptionDetail, setCategoryOptionDetail] = useState('');
	
		const market = (e) => {
			setCategoryOption(e.target.checked);
		};
	
		const marketDetail = (e) => {
			setCategoryOptionDetail(e.target.checked);
		};
	
		if(categoryOption && categoryOptionDetail) {
			// 두 개의 라디오 버튼이 모두 선택되었을 때 제출 처리
		} else {
			
		}

		const handleSubmit = (event) => {
			event.preventDefault();
		};
	return (
		<section className='header'>
			<Link href="/">
				<img className='header-title' src="/img/goodsmarketlogo.png" alt="" />
			</Link>
			<form src="#" className='header-search-form'>
				<div className='header-selectbar' onClick={showSearchSet}>
					<span className='header-seacrh-list'>{searchListset}</span>
					<img src="/img/selectbtn.png" className={iconRotate} />
				</div>
				<div className={displayFlex}>
					<span onClick={setSearchList}>전체</span>
					<span onClick={setSearchList}>작성자</span>
					<span onClick={setSearchList}>제목</span>
					<span onClick={setSearchList}>제목+내용</span>
					<span onClick={setSearchList}>해시태그</span>
				</div>
				<input type="text" className='header-search' />
				<button className='header-searchbtn'><img src="/img/search.png" alt="" className='header-search-icon' /></button>
			</form>

			<Link to="/chat">
				<img src="/img/chat.png" alt="" className='header-icon' />
			</Link>

			<div><img src="/img/newboard.png" alt="" className='header-icon' /></div>

			<Link to="/chat"><img src="/img/noticebell.png" alt="" className='header-icon' /></Link>
				<div>
					<div onClick={showInsert} className='header-profile'>
						<img src="/img/profileimg.png" alt="" className='header-icon' />
						<img src="/img/down_btn.png" alt="" className='header-icon-down' />
					</div>
					<div className={headerMypage}>
						<Link to="/mypage">마이페이지</Link>
						<Link to="/lastshow" >최근 본 항목</Link>
						<Link to="/login">로그인</Link>
						<Link to="/logout">로그아웃</Link>
					</div>
				</div>

			<img src="/img/hamburger.png" className='header-category-icon' onClick={showCategories} />
			<div className={categoryBlock}>
				<form className='category-main'>
				<section className='category category-border'>
					<span>장터</span>
					<div>
						<div className='category-select'>
							<input type="radio" value='1' name='market' id='market1'
									checked={categoryOption} onChange={market}/>
							<label htmlFor="market1" className='category-select'>굿즈 양도</label>
						</div>
						<div className='category-select'>
							<input type="radio" value='2' name='market' id='market2'
									checked={categoryOption} onChange={market}/>
							<label htmlFor="market2" className='category-select'>제작 판매</label>
						</div>
						<div className='category-select'>
						<Link to="/" className='category-select'>홍보 게시판</Link>
						</div>
					</div>
				</section>
				<section className='category'>
					<span>하위 분류</span>
					<div className='category-detail-grid'>
						<div className='category-select'>
							<input type="radio" value='1' name='market_detail' id='marketDetail1'
									checked={categoryOptionDetail} onChange={marketDetail}/>
							<label htmlFor="marketDetail1" className='category-select'>인형</label>
						</div>
						<div className='category-select'>
							<input type="radio" value='5' name='market_detail' id='marketDetail5'
									checked={categoryOptionDetail} onChange={marketDetail}/>
							<label htmlFor="marketDetail5" className='category-select'>피규어/스탠드</label>
						</div>
						<div className='category-select'>
							<input type="radio" value='9' name='market_detail' id='marketDetail9'
									checked={categoryOptionDetail} onChange={marketDetail}/>
							<label htmlFor="marketDetail9" className='category-select'>아이돌</label>
						</div>
						<div className='category-select'>
							<input type="radio" value='13' name='market_detail' id='marketDetail13'
									checked={categoryOptionDetail} onChange={marketDetail}/>
							<label htmlFor="marketDetail13" className='category-select'>이모티콘 캐릭터</label>
						</div>
						<div className='category-select'>
							<input type="radio" value='2' name='market_detail' id='marketDetail2'
									checked={categoryOptionDetail} onChange={marketDetail}/>
							<label htmlFor="marketDetail2" className='category-select'>게임</label>
						</div>
						<div className='category-select'>
							<input type="radio" value='6' name='market_detail' id='marketDetail6'
									checked={categoryOptionDetail} onChange={marketDetail}/>
							<label htmlFor="marketDetail6" className='category-select'>애니/만화</label>
						</div>
						<div className='category-select'>
							<input type="radio" value='10' name='market_detail' id='marketDetail10'
									checked={categoryOptionDetail} onChange={marketDetail}/>
							<label htmlFor="marketDetail10" className='category-select'>배우</label>
						</div>
						<div></div>
						<div className='category-select'>
							<input type="radio" value='3' name='market_detail' id='marketDetail3'
									checked={categoryOptionDetail} onChange={marketDetail}/>
							<label htmlFor="marketDetail3" className='category-select'>창작</label>
						</div>
						<div className='category-select'>
							<input type="radio" value='7' name='market_detail' id='marketDetail7'
									checked={categoryOptionDetail} onChange={marketDetail}/>
							<label htmlFor="marketDetail7" className='category-select'>웹툰/웹소설</label>
						</div>
						<div className='category-select'>
							<input type="radio" value='11' name='market_detail' id='marketDetail11'
									checked={categoryOptionDetail} onChange={marketDetail}/>
							<label htmlFor="marketDetail11" className='category-select'>영화/드라마</label>
						</div>
						<div></div>
						<div className='category-select'>
							<input type="radio" value='4' name='market_detail' id='marketDetail4'
									checked={categoryOptionDetail} onChange={marketDetail}/>
							<label htmlFor="marketDetail4" className='category-select'>유튜버</label>
						</div>
						<div className='category-select'>
							<input type="radio" value='8' name='market_detail' id='marketDetail8'
									checked={categoryOptionDetail} onChange={marketDetail}/>
							<label htmlFor="marketDetail8" className='category-select'>버츄얼</label>
						</div>
						<div className='category-select'>
							<input type="radio" value='12' name='market_detail' id='marketDetail12'
									checked={categoryOptionDetail} onChange={marketDetail}/>
							<label htmlFor="marketDetail12" className='category-select'>뮤지컬</label>
						</div>
					</div>
				</section>
				</form>
			</div>
		</section>
    );
}

export default Header;