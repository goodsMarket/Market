import React, { useState } from "react";
import '/css/main.css';

const ProductionBox = (props) => {

    const data = props?.data;
    
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
        <div className={data ? "productionbox-grid " + data : "productionbox-grid"}>
            <div className="productionbox-titleimg-area">
                <img src="/img/testprofile.png" alt="" className="productionbox-title-img" />
            </div>
                <img src={heart2} alt="" onClick={changeImg} className="productionbox-heart" />
            <div className="productionbox-flex">
                <img src="/img/profileimg.png" alt="" className="productionbox-profileimg" />
                <span className="productionbox-nickname">닉네임</span>
            </div>
            <div className="productionbox-flex">
                <div className="productionbox-title">제목입니다.</div>
            </div>
            <div className="productionbox-flex productionbox-date">
                <span>2024-02-03</span>
                <span>-</span>
                <span>2024-02-30</span>
            </div>
            <div className="productionbox-views-flex">
                <img src="/img/views.png" alt="" className="productionbox-views-img"/>
                <span>1,123</span>
            </div>
        </div>
    );

}
export default ProductionBox;