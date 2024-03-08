import React, { useEffect } from 'react';
import axios from 'axios';

function UserList() {

  //정보가져오기
  function getUserList () {
  
    try {
        const response = axios.post('http://localhost:3001/api/data', {
          key1: 'value1',
          key2: 'value2',
          // 여기에 데이터 추가
        });
        console.log(response.data); // 성공적으로 데이터를 전송한 후의 응답 확인
    } catch (error) {
      console.error(error); // 오류 처리
    }
  }
  getUserList()
  return (
    <div className="contents">
      
    </div>
  )
}

export default getUserList;