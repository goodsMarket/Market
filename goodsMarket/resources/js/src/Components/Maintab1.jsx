
import React, { useState } from "react";
import Searchchart from "./Searchchart";
import UsedProductionBox from '../Components/UsedProductionBox';
import CategoryCarousel from '../Components/CategoryCarousel';
import SeemoreBotton from '../Components/SeemoreBotton';
import Event from "./Event";

const Maintab1 = () => {

    const seemore = {
        margin: '0 30px 17px 0',
    };

    return (
        <div>
            <section className="main-width">
                <div className="main-see-more">
                    <h2 className="main-titles">
                        최근 본 게시물
                    </h2>
                    <SeemoreBotton style={seemore}>더보기</SeemoreBotton>
                </div>
                    <div className="maintab-second-lastboard">
                        <UsedProductionBox />
                        <UsedProductionBox />
                        <UsedProductionBox />
                        <UsedProductionBox />
                    </div>
                    <div className="main-see-more">
                        <h2 className="main-titles">
                            추천순
                        </h2>
                        <SeemoreBotton style={seemore}>더보기</SeemoreBotton>
                    </div>
                    <div className="maintab-second-lastboard">
                        <UsedProductionBox />
                        <UsedProductionBox />
                        <UsedProductionBox />
                        <UsedProductionBox />
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
                    <div className="main-see-more">
                        <h2 className="main-titles">
                            최근 본 게시물
                        </h2>
                        <SeemoreBotton style={seemore}>더보기</SeemoreBotton>
                    </div>
                    <div className="maintab-second-lastboard-eight">
                        <UsedProductionBox />
                        <UsedProductionBox />
                        <UsedProductionBox />
                        <UsedProductionBox />
                        <UsedProductionBox />
                        <UsedProductionBox />
                        <UsedProductionBox />
                        <UsedProductionBox />
                    </div>
                    <h2 className="main-titles">
                        행사 홍보
                    </h2>
                    <div className="main-event-section">
                        <Event />
                        <Event />
                        <Event />
                        <Event />
                    </div>
            </section>
        </div>
    );

}
export default Maintab1;