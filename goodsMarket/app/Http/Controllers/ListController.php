<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListController extends BoardController
{
    /**
     * 리스트 출력 - 중고 거래
     */
    protected function index()
    {
        /**
         * 기대값: 배열 안에 객체로 들어있는 이미지, 제목, 내용 등
         */
        return UsedTrade::orderByDesc('created_at')->limit(16)->get();
    }
}
