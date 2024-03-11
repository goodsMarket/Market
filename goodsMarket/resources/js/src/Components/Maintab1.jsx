
import React, { useState } from "react";
import Searchchart from "./Searchchart";
import UsedProductionBox from '../Components/UsedProductionBox';
import Event from "./Event";

const Maintab1 = () => {
    
    
    // [lists, setLists] = useState([
    //     {id: 1,  p_start_date: 20240218, p_end_date: 20240231, p_title:'제목'},
    //     {id: 1,  p_start_date: 20240218, p_end_date: 20240231, p_title:'제목'},
    //     {id: 1,  p_start_date: 20240218, p_end_date: 20240231, p_title:'제목'}
    // ]);
    // const lastBoardList = lists.map(item => <li key={item.id}>{item.p_title}</li>);

    return (
        <div>                                      
            <section >
                <h2 className="main-titles">
                    최근 본 게시물
                </h2>
                <div className="maintab-second-lastboard">
                    <UsedProductionBox />
                    <UsedProductionBox />
                    <UsedProductionBox />
                    <UsedProductionBox />
                </div>
                <h2 className="main-titles">
                    추천순
                </h2>
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
                <div className="maintab-second-searchArea">
                    <Searchchart />
                </div>
                <h2 className="main-titles">
                    최근 게시글
                </h2>
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