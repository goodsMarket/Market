import React, { useState } from 'react';
import { BrowserRouter as Router, Link } from 'react-router-dom';
import { styled } from "styled-components";
import Carousel from '../Components/Carousel';
import Maintab1 from '../Components/Maintab1';
import Maintab2 from '../Components/Maintab2';
import '/css/main.css';

function Main() {

	const Box = styled.div`
    display: flex;
    flex-direction: column;
    width: 100%;
    `;

    const TabBox = styled.div`
    display: flex;
    background-color:#F7F7F7;
    `;

    const TabButton = styled.button`
    border: none;
    width: 50%;
    height: 60px;
    font-size : 1.2rem;
    font-weight: bold;
    box-sizing: border-box;
    border-bottom: ${({ "data-active": dataActive }) =>
    dataActive === "true" ? "3px solid #13B9EE" : "transparent"};
    background-color: ${({ "data-active": dataActive }) =>
        dataActive === "true" ? "#ffffff" : "transparent"};
    color: ${({ "data-active": dataActive }) =>
        dataActive === "true" ? "#13B9EE" : "#B7B7B7"};
    cursor: pointer;
    `;

	const TabContent = styled.div`
	padding: 10px;
	`;

	const TabData = [
		{id : 1 , button : '굿즈 양도'},
		{id : 2 , button : '굿즈 제작 판매'}
	]
	const renderTabComponent = () => {
        if (activeTab === 1) {
            return <Maintab1 />;
        } else if (activeTab === 2) {
            return <Maintab2 />;
        }
        // 다른 경우에는 null을 반환하거나 기본적으로 렌더링할 컴포넌트를 반환할 수 있습니다.
        return null;
    };

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
						<img src="/img/testprofile.png" alt=""/>
						<span>닉네임</span>
					</Link>
					<Link to='/' className='main-author-profile'>
						<img src="/img/testprofile.png" alt=""/>
						<span>닉네임</span>
					</Link>
					<Link to='/' className='main-author-profile'>
						<img src="/img/testprofile.png" alt=""/>
						<span>닉네임</span>
					</Link>
					<Link to='/' className='main-author-profile'>
						<img src="/img/testprofile.png" alt=""/>
						<span>닉네임</span>
					</Link>
					<Link to='/' className='main-author-profile'>
						<img src="/img/testprofile.png" alt=""/>
						<span>닉네임</span>
					</Link>
					<Link to='/' className='main-author-profile'>
						<img src="/img/testprofile.png" alt=""/>
						<span>닉네임</span>
					</Link>
					<Link to='/' className='main-author-profile'>
						<img src="/img/testprofile.png" alt=""/>
						<span>닉네임은최<br />대열글자로</span>
					</Link>
					<Link to='/' className='main-author-profile'>
						<img src="/img/testprofile.png" alt=""/>
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
					{renderTabComponent()}
				</TabContent>
			</Box>
			</section>
		</div>
    );
}
export default Main;