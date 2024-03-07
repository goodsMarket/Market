<?php

namespace App\Http\Controllers;

use App\Models\UsedTrade;
use Illuminate\Http\Request;

class ListController extends BoardController
{
    /**
     * 게시글 리스트 출력 틀
     */
    protected function index_ut($page = 1)
    {
        $this->boardType = [
            // 출력개수 => 엘로퀀트 인스턴스,
            '16' => UsedTrade::class,
        ];

        $this->indexPage = $page;

        return response()->json(['message' => $this->index()]);
        // return $this->index();
    }

    /**
     * 삭제된 게시글 리스트 출력 틀
     */
    protected function index_deleted($page = 1)
    {
        $this->boardType = [
            // 출력개수 => 엘로퀀트 인스턴스,
            '16' => UsedTrade::class,
        ];

        $this->indexPage = $page;

        return response()->json(['message' => $this->index()]);
        // return $this->index();
    }
}
