
import React, { useState, useEffect } from "react";
import Searchchart from "./Searchchart";
import ProductionBox from "./ProductionBox";
import '/css/main.css';

const Maintab2 = (props) => {
    
    const data = props.data;

    useEffect(() => {
        // 첨에 안돌림: 받아오느라 시간 걸려서 오류날거임
        if(!data) return null;

        // 값 돌리면서 렌더링 된 애들한테 뿌려줄 것임 : 원래는 렌더링 할 때 이미 데이터를 받아야 하는 상태
        data['recent_view'].forEach(element => {
            // 클래스는 rendering하면서 줬으니까 클래스 가지고 와서 
            console.log(element);
        });

    }, [data]); // 데이타 받아오면 호출

    const printCount = 16;
    let nowCount = 0;

    const rendering = (selectType) => {
        const result = [];
        for (let i = 0; i < printCount; i++) {
            // key는 되도록 id같은 유니크한거 지향이지만 일단 실행ㅡid주려면 렌더링과 동시에 출력하는 로직으로 다시 짜야 함ㅡ            result.push(<ProductionBox key={nowCount} data={selectType} />); 
            nowCount++;
        }
        return result;
    };

    return (
        <div>
            <section >
                <h2 className="main-author-title">
                    최근 본 게시물
                </h2>
                <div className="maintab-second-lastboard">
                    {rendering('recent_view')}
                </div>
                <h2 className="main-author-title">
                    인기 게시글
                </h2>
                <div className="maintab-second-lastboard">
                    {rendering('recommand')}
                </div>
                <h2 className="main-author-title">
                    실시간 검색 순위
                    <img src="/img/crown.png" alt="" className="maintab-second-titleimg" />
                </h2>
                <div className="maintab-second-searchArea">
                    <Searchchart />
                </div>
            </section>
        </div>
    );

}
export default Maintab2;