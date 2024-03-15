<?php

namespace App\Http\Controllers;

use App\Models\UsedTradeReceipt;
use Illuminate\Http\Request;

class UsedTradeReceiptController extends ReceiptController
{
    /**
     * 적용 엘로퀀트 정의
     */
    public function __construct()
    {
        $this->boardType = new UsedTradeReceipt();
    }
    
    /**
     * 주문 생성
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function store_utr(Request $request){
        $this->safeData = $request;
        $this->store(null);
    }
    
    /**
     * 주문 조회
     */
    public function view_utr(){
        //
    }
    
    /**
     * 주문 수정/환불
     */
    public function update_utr(){
        //
    }
}
