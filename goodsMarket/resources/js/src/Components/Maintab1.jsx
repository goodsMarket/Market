
import React, { useState } from "react";
import Searchchart from "./Searchchart";

const Maintab1 = () => {
    
    
    // [lists, setLists] = useState([
    //     {id: 1,  p_start_date: 20240218, p_end_date: 20240231, p_title:'제목'},
    //     {id: 1,  p_start_date: 20240218, p_end_date: 20240231, p_title:'제목'},
    //     {id: 1,  p_start_date: 20240218, p_end_date: 20240231, p_title:'제목'}
    // ]);
    // const lastBoardList = lists.map(item => <li key={item.id}>{item.p_title}</li>);

    return (
        <div>
            Maintab1
            <Searchchart />
        </div>
    );

}
export default Maintab1;