import React, { useState } from "react";
import '/css/main.css';

const ProductionBox = (props) => {

    const {data} = props;
    
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
                <img src={data?.p_thumbnail ? data.p_thumbnail : "/img/testprofile.png"} alt="" className="productionbox-title-img" />
            </div>
                <img src={heart2} alt="" onClick={changeImg} className="productionbox-heart" />
            <div className="productionbox-flex">
                <img src={data?.u_profile_img ? data.u_profile_img : "/img/profileimg.png"} alt="" className="productionbox-profileimg" />
                <span className="productionbox-nickname">{data?.u_nickname ? data.u_nickname : '(알수없음)'}</span>
            </div>
            <div className="productionbox-flex">
                <div className="productionbox-title">{data?.p_title ? data.p_title : '(제목없음)'}</div>
            </div>
            <div className="productionbox-flex productionbox-date">
                <span>{data?.p_start_date ? data.p_start_date : '(X)'}</span>
                <span>-</span>
                <span>{data?.p_end_date ? data.p_end_date : '(X)'}</span>
            </div>
            <div className="productionbox-views-flex">
                <img src="/img/views.png" alt="" className="productionbox-views-img"/>
                <span>{data?.p_view ? data.p_view : '(X)'}</span>
            </div>
        </div>
    );

}
export default ProductionBox;