<?php

namespace App\Http\Controllers;

use App\Models\Production;
use App\Models\UsedTrade;
use Exception;
use Illuminate\Http\Request;

class ListController extends BoardController
{
    /**
     * 최근 게시글 중고
     * @param object $cookie
     * @param int|null $page
     */
    protected function main_ut($cookie, $page = 1)
    {
        try {
            // 엘로퀀트 인스턴스, 출력개수, 불러올 종류
            array_push(
                $this->callPacakge, 
                [UsedTrade::class, 16, 'recent'],
                [UsedTrade::class, 16, 'sold_out'],
                [UsedTrade::class, 16, 'recent_see'],
            );
    
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
     * 최근 게시글 제작
     * @param int|null $page
     */
    protected function main_p($page = 1)
    {
        try {
            // 엘로퀀트 인스턴스, 출력개수
            array_push($this->boardType, [Production::class, 16]);
    
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
     * --- 보류 ---
     * 최근거래 중고
     * @param int|null $page
     */
    protected function sold_out_ut($page = 1)
    {
        try {
            // 엘로퀀트 인스턴스, 출력개수
            array_push($this->boardType, [UsedTrade::class, 16]);
    
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
     * --- 보류 ---
     * 최근거래 중고
     * @param int|null $page
     */
    protected function sold_out_p($page = 1)
    {
        try {
            // 엘로퀀트 인스턴스, 출력개수
            array_push($this->boardType, [UsedTrade::class, 16]);
    
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
     * 삭제된 
     * @param int|null $page
     */
    protected function recent_deleted_ut($page = 1)
    {
        try {
            // 엘로퀀트 인스턴스, 출력개수
            array_push($this->boardType, [UsedTrade::class, 16]);
    
            $this->boardPage = $page;

            $this->index_deleted() ? $message = $this->index_deleted() : throw new Exception('없는 페이지입니다.');
    
            return response()->json(['message' => $message]);
            // return $this->index();
        } catch (Exception $e) {
            $error = json_decode($e->getMessage()) !== null ? json_decode($e->getMessage()) : $e->getMessage();
            return response()->json(['error' => $error]);
        }
    }
}
