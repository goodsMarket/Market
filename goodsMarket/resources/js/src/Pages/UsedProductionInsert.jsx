import React, { useState, useEffect } from 'react';
import Button from "../Components/Button";
import Insertbox from "../Components/insertbox";
import '/css/boardinsert.css';
import axios from 'axios';

const UsedProductionInsert = () => {

    const [form, setForm] = useState({
        ut_title: '',
        c_major: '',
        c_sub: '',
        c_detail: '',
        ut_thumbnail: '',
        ut_price: '',
        ut_count: '',
        ut_description: '',
        ut_refund: '',

    });

    return (
        <div className='usedInsert-main'>
            <div className='usedInsert-section'>
                <h3 className='usedInsert-h3'>
                    <span className='usedInsert-essential'>*</span>
                    상품정보
                </h3>
                <Insertbox>
                    <h3 className='usedInsert-h3'>
                        <span className='usedInsert-essential'>*</span>
                        상품 사진
                    </h3>
                    <input type="file" id="img"  name='bi_img_path[]' value={form.bi_img_path} className='usedInsert-insertImg'/>
                    <label htmlFor="img"><img src="/img/photo_insert.png" alt="" /></label>
                </Insertbox>
                <Insertbox>
                    <div className='usedInsert-div-section'>
                        <h3 className='usedInsert-h3'>
                            <span className='usedInsert-essential'>*</span>
                            상품명
                        </h3>
                        <input type="text" name="ut_title" value={form.ut_title} className='usedInsert-input' />
                    </div>
                </Insertbox>
                <Insertbox>
                    <div className='usedInsert-div-section'>
                        <h3 className='usedInsert-h3'>
                            <span className='usedInsert-essential'>*</span>
                            카테고리
                        </h3>
                        <div>
                            <input type="hidden" name='c_major' value={form.c_major} />
                            <input type="hidden" name='c_sub' value={form.c_sub} />
                            <input type="hidden" name='c_detail' value={form.c_detail} />
                        </div>
                    </div>
                </Insertbox>
                <Insertbox>
                    <div className='usedInsert-div-section'>
                        <h3 className='usedInsert-h3'>
                            <span className='usedInsert-essential'>*</span>
                            가격
                        </h3>
                        <input type="text" name="ut_price" value={form.ut_price} className='usedInsert-input' />
                    </div>
                </Insertbox>
            </div>
        </div>
    )
}

export default UsedProductionInsert;
