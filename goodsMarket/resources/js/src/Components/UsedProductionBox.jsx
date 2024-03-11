import React, { useState } from "react";
import Searchchart from './Searchchart';
import '/css/main.css';

const UsedProductionBox = () => {
    
    const [heart2, setHeart] = useState('/img/heart.png');
    const [heart, setHeart2] = useState('/img/heart.png');

    const changeImg = () => {
        if (heart !== heart2) {
            setHeart(heart);
        } else {
            setHeart('/img/heart2.png');
        }
    };

    return (
        <div className="productionbox-grid">
            <div className="productionbox-titleimg-area">
                <img src="/img/testprofile.png" alt="" className="productionbox-title-img" />
            </div>
            <img src={heart2} alt="" onClick={changeImg} className="productionbox-heart" />
            <div className="productionbox-flex">
                <div className="productionbox-title">제목입니다.</div>
            </div>
            <div className="productionbox-address">
                경기도 용왕시 왕십리(이하생략)
            </div>
            <div className="productionbox-date-price">
                <div>2일전</div>
                <div>
                    <span className="productionbox-price">13,000<span className="productionbox-price-won"> 원</span></span>
                </div>
            </div>
        </div>
    );

}
export default UsedProductionBox;