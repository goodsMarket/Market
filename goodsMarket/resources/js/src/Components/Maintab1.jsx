
import React, { useState } from "react";
import Searchchart from "./Searchchart";

const Maintab1 = (props) => {
    
    const { data } = props;

    console.log(data);
    
    // [lists, setLists] = useState([
    //     {id: 1,  p_start_date: 20240218, p_end_date: 20240231, p_title:'제목'},
    //     {id: 1,  p_start_date: 20240218, p_end_date: 20240231, p_title:'제목'},
    //     {id: 1,  p_start_date: 20240218, p_end_date: 20240231, p_title:'제목'}
    // ]);
    // const lastBoardList = lists.map(item => <li key={item.id}>{item.p_title}</li>);

    return (
        <div>
            Maintab1
            <h2>최근 본 게시물</h2>
            {/* {recentView()} */}
            <Searchchart />
        </div>
    );

}
export default Maintab1;