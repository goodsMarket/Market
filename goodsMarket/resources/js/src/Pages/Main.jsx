import React, { useState, useEffect, memo } from 'react';
import axios from 'axios';
import { BrowserRouter as Router, Link } from 'react-router-dom';
import Carousel from '../Components/Carousel';
import Maintab1 from '../Components/Maintab1';
import Maintab2 from '../Components/Maintab2';
import '/css/main.css';
import { useCookies } from 'react-cookie';
import { Box, TabBox, TabButton, TabContent } from '../Module/Style';

function Main() {
	console.log('Main');

	const [TabData, setTabData] = useState([
		{ id: 1, button: '굿즈 양도' },
		{ id: 2, button: '굿즈 제작 판매' }
	]);

	const [listResponse, setlistResponse] = useState([])

	useEffect(() => {
		axios.patch('/list')
			.then(res => {
				if (res?.message) {
					setlistResponse(res.data.message);
					console.log(listResponse);
				} else {
					console.log(res);
				}
			})
			.catch(err => {
				console.log(err.stack);
			})
	}, []);

	const [activeTab, setActiveTab] = useState(TabData[0].id);

	return (
		<div>
			<section className='main-carousel'>
				<img src="/img/carousel1.png" alt="" />
				{/* <Carousel /> */}
			</section>
			<section className='main-author-section'>
				<div>
					<h2 className='main-author-title'>금주의 인기 작가</h2>
				</div>
				<div className='main-author-list'>
					<Link to='/' className='main-author-profile'>
						<img src="/img/testprofile.png" alt="" />
						<span>닉네임</span>
					</Link>
					<Link to='/' className='main-author-profile'>
						<img src="/img/testprofile.png" alt="" />
						<span>닉네임</span>
					</Link>
					<Link to='/' className='main-author-profile'>
						<img src="/img/testprofile.png" alt="" />
						<span>닉네임</span>
					</Link>
					<Link to='/' className='main-author-profile'>
						<img src="/img/testprofile.png" alt="" />
						<span>닉네임</span>
					</Link>
					<Link to='/' className='main-author-profile'>
						<img src="/img/testprofile.png" alt="" />
						<span>닉네임</span>
					</Link>
					<Link to='/' className='main-author-profile'>
						<img src="/img/testprofile.png" alt="" />
						<span>닉네임</span>
					</Link>
					<Link to='/' className='main-author-profile'>
						<img src="/img/testprofile.png" alt="" />
						<span>닉네임</span>
					</Link>
					<Link to='/' className='main-author-profile'>
						<img src="/img/testprofile.png" alt="" />
						<span>닉네임</span>
					</Link>
				</div>
			</section>
			<section >
				<div className='main-promotion'>
					<div>홍보영역</div>
				</div>
			</section>
			<section className='main-tab'>
				<Box>
					<TabBox>
						{TabData.map((tab) => (
							<TabButton
								key={tab.id}
								data-active={activeTab === tab.id ? "true" : "false"}
								onClick={() => setActiveTab(tab.id)}>
								{tab.button}
							</TabButton>
						))}
					</TabBox>
					<TabContent>
						{activeTab === 1 ? <Maintab1 data={listResponse.used_trades} /> : activeTab === 2 ? <Maintab2 data={listResponse.productions} /> : <></>}
					</TabContent>
				</Box>
			</section>
		</div>
	);
}
export default memo(Main);