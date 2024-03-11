<?php

namespace App\Http\Controllers;

use App\Models\Production;
use App\Models\UsedTrade;
use App\Modules\ArrayToParam;
use Exception;
use Illuminate\Http\Request;

class ListController extends BoardController
{
    /**
     * 메인 페이지 중고
     * @param \Illuminate\Http\Request $request
     */
    protected function main_ut(Request $request)
    {
        try {
            // 엘로퀀트 인스턴스 => [출력개수, 불러올 종류]
            $this->callPacakge = [
                'used_trades' => [
                    16 => [
                        'recent_view',
                        'recent',
                    ],
                    40 => [
                        'recommand',
                        'sold_out',
                    ],
                ],
                'productions' => [
                    16 => [
                        'recent_view',
                        'recent',
                    ],
                    40 => [
                        'recommand',
                        'sold_out',
                    ],
                ],
            ];

            $request->hasCookie('recent_view') ? $this->cookie = $request->cookie('recent_view') : '';

            return response()->json(['message' => $this->index()]);
            // return $this->index();
        } catch (Exception $e) {
            $error = json_decode($e->getMessage()) !== null ? json_decode($e->getMessage()) : $e->getMessage();
            return response()->json(['error' => $error]);
        }
    }

    /**
     * --- 보류 ---
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
