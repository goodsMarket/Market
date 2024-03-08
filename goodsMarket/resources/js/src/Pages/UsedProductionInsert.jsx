import React, { useState, useEffect } from 'react';
import Button from "../Components/Button";
import Insertbox from "../Components/insertbox";
import '/css/boardinsert.css';
import axios from 'axios';

const UsedProductionInsert = () => {
    return (
        <div className='usedInsert-main'>
            <Insertbox>테스트</Insertbox>
        </div>
    )
}

export default UsedProductionInsert
