
import React, { useState } from "react";
import Searchchart from "./Searchchart";
import ProductionBox from "./ProductionBox";
import CategoryCarousel from '../Components/CategoryCarousel';
import SeemoreBotton from '../Components/SeemoreBotton';
import '/css/main.css';

const Maintab2 = () => {
    
    const seemore = {
        margin: '0 30px 17px 0',
    };

    return (
        <div>
            <section className="main-width" >
                <div className="main-see-more">
                    <h2 className="main-titles">
                        최근 게시물
                    </h2>
                    <SeemoreBotton style={seemore}>더보기</SeemoreBotton>
                </div>
                <div className="maintab-second-lastboard">
                    <ProductionBox />
                    <ProductionBox />
                    <ProductionBox />
                    <ProductionBox />
                </div>
                <div className="main-see-more">
                    <h2 className="main-titles">
                        인기 굿즈 제작
                    </h2>
                    <SeemoreBotton style={seemore}>더보기</SeemoreBotton>
                </div>
                <div className="maintab-second-lastboard">
                    <ProductionBox />
                    <ProductionBox />
                    <ProductionBox />
                    <ProductionBox />
                </div>
                <h2 className="main-titles">
                    실시간 검색 순위
                <img src="/img/crown.png" alt="" className="maintab-second-titleimg"/>
                </h2>
            </section>
                <div className="maintab-second-searchArea">
                    <Searchchart />
                </div>
                <CategoryCarousel />
            <section className="main-width">
                <h2 className="main-titles">
                    최근 게시물
                </h2>
                <div className="maintab-second-lastboard-eight">
                    <ProductionBox />
                    <ProductionBox />
                    <ProductionBox />
                    <ProductionBox />
                    <ProductionBox />
                    <ProductionBox />
                    <ProductionBox />
                    <ProductionBox />
                </div>
            </section>
        </div>
    );

}
export default Maintab2;