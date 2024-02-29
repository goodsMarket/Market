
import React, { useState } from "react";
import Searchchart from "./Searchchart";
import ProductionBox from "./ProductionBox";
import '/css/main.css';

const Maintab2 = () => {
    
    return (
        

        <div>
            <section >
                <h2 className="main-author-title">
                    최근게시물
                </h2>
                <div className="maintab-second-lastboard">
                    <ProductionBox />
                    <ProductionBox />
                    <ProductionBox />
                    <ProductionBox />
                    <ProductionBox />
                    <ProductionBox />
                </div>
                <h2 className="main-author-title">
                    인기 게시글
                </h2>
                <div className="maintab-second-lastboard">
                    <ProductionBox />
                    <ProductionBox />
                    <ProductionBox />
                    <ProductionBox />
                </div>
                <h2 className="main-author-title">
                    실시간 검색 순위
                <img src="/img/crown.png" alt="" className="maintab-second-titleimg"/>
                </h2>
                <div className="maintab-second-searchArea">
                    <Searchchart />
                </div>
            </section>
        </div>
    );

}
export default Maintab2;