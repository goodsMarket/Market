<?php

namespace App\Http\Controllers;

use App\Models\UsedTrade;
use Exception;
use Illuminate\Http\Request;

class ListController extends BoardController
{
    /**
     * 게시글 리스트 출력 틀
     */
    protected function index_ut($page = 1)
    {
        try {
            $this->boardType = [];

            // 엘로퀀트 인스턴스, 출력개수
            array_push($this->boardType, [UsedTrade::class, 5]);
    
            $this->boardPage = $page;

            $this->index() ? $message = $this->index() : throw new Exception('없는 페이지입니다.');
    
            return response()->json(['message' => $message]);
            // return $this->index();
        } catch (Exception $e) {
            $error = json_decode($e->getMessage()) !== null ? json_decode($e->getMessage()) : $e->getMessage();
            return response()->json(['error' => $error]);
        }
    }

    /**
     * 삭제된 게시글 리스트 출력 틀
     */
    protected function index_deleted($page = 1)
    {
        try {
            // 
            
            return response()->json(['message' => $this->index()]);
            // return $this->index();
        } catch (Exception $e) {
            $error = json_decode($e->getMessage());
            return response()->json(['error' => $error]);
        }
    }
}
