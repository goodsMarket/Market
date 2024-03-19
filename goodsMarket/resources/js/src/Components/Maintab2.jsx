
import React, { useState, useEffect, memo } from "react";
import Searchchart from "./Searchchart";
import ProductionBox from "./ProductionBox";
import '/css/main.css';

const Maintab2 = (props) => {
    console.log('Maintab2');

    const { data } = props;

    const [recent_view, set_recent_view] = useState([]);
    const [recommand, set_recommand] = useState([]);
    const [recent, set_recent] = useState([]);
    const [sold_out, set_sold_out] = useState([]);

    const stateSwitch = (key, value) => {
        switch (key) {
            case 'recent_view':
                set_recent_view(value);
                break;
            case 'recommand':
                set_recommand(value);
                break;
            case 'recent':
                set_recent(value);
                break;
            case 'sold_out':
                set_sold_out(value);
                break;
            default:
                console.log('해당하지 않는 항목입니다.');
                break;
        }
    };

    useEffect(() => {
        // 첨에 안돌림: 받아오느라 시간 걸려서 오류날거임
        if (!data) return null;

        // 값 돌리면서 렌더링 된 애들한테 뿌려줄 것임 : 원래는 렌더링 할 때 이미 데이터를 받아야 하는 상태
        for (let i in data) {
            stateSwitch(i, data[i]);
        }

    }, [data]); // 데이타 받아오면 호출

    return (
        <div>
            <section >
                <h2 className="main-author-title">
                    최근 본 게시물
                </h2>
                <div className="maintab-second-lastboard">
                    {recent_view.map(item => (
                        <ProductionBox key={item.id} data={item} />
                    ))}
                </div>
                <h2 className="main-author-title">
                    인기 게시글
                </h2>
                <div className="maintab-second-lastboard">
                    {recommand.map(item => (
                        <ProductionBox key={item.id} data={item} />
                    ))}
                </div>
                <h2 className="main-author-title">
                    실시간 검색 순위
                    <img src="/img/crown.png" alt="" className="maintab-second-titleimg" />
                </h2>
                <div className="maintab-second-searchArea">
                    <Searchchart />
                </div>
                <h2 className="main-author-title">
                    신규작가
                </h2>
                <h2 className="main-author-title">
                    최근 게시글
                </h2>
                <div className="maintab-second-lastboard">
                    {recent.map(item => (
                        <ProductionBox key={item.id} data={item} />
                    ))}
                </div>
                <h2 className="main-author-title">
                    출시예정
                </h2>
                <h2 className="main-author-title">
                    행사홍보
                </h2>
                <h2 className="main-author-title">
                    최근 리뷰
                </h2>
            </section>
        </div>
    );

}
export default memo(Maintab2);