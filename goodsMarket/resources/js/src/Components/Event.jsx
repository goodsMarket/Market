import React from 'react'
import '/css/main.css';

export default function Event() {
    return (
        <div className='event-main'>
            <div className='event-section'>
                <div className='event-title'>
                    행사 홍보 게시글 제목입니다.
                </div>
                <div className='event-content'>
                    <div className='event-detail-content'>
                        <div className='event-profile'>
                            <img src="/img/profileimg.png" alt="" className="productionbox-profileimg" />
                            <span className="productionbox-nickname">닉네임</span>
                        </div>
                    </div>
                    <div className='event-date'>
                        2024-03-24
                    </div>
                </div>
            </div>
        </div>
    )
}
