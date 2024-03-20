import React, { useState, memo } from "react";
import '/css/main.css';
import formDate from '../Module/FormDate';
import { Link } from 'react-router-dom';

const UsedTradeBox = (props) => {

    const { data } = props;

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
                <Link to={{ pathname: '/used', search: `?id=${data.id}` }}>
                    <img src={data?.ut_thumbnail ? data.ut_thumbnail : "/img/testprofile.png"} alt="" className="productionbox-title-img" />
                </Link>
            </div>
            <img src={heart2} alt="" onClick={changeImg} className="productionbox-heart" />
            {/* <div className="productionbox-flex">
                <img src={data?.u_profile_img ? data.u_profile_img : "/img/profileimg.png"} alt="" className="productionbox-profileimg" />
                <span className="productionbox-nickname">{data?.u_nickname ? data.u_nickname : '(알수없음)'}</span>
            </div> */}
            <div className="productionbox-flex">
                <Link to={{ pathname: '/used', search: `?id=${data.id}` }}>
                    <div className="productionbox-title">{data?.ut_title ? data.ut_title : '(제목없음)'}</div>
                </Link>
            </div>
            <div className="productionbox-flex productionbox-date">
                <span>{data?.sa_address ? data.sa_address : '(전국?)'}</span>
            </div>
            <div className="productionbox-views-flex">
                <span>{data?.ut_price ? data.ut_price + '원' : '(경매?)'}</span>
            </div>
            <div className="productionbox-views-flex">
                <span>{data?.created_at ? formDate(data.created_at) : '(미확인)'}</span>
            </div>
        </div>
    );

}
export default memo(UsedTradeBox);