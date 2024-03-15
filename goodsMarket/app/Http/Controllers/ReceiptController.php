<?php

namespace App\Http\Controllers;

use App\Modules\MyRes;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReceiptController extends BoardController
{
    /**
     * 게시글 작성 틀
     * 
     * 요구멤버: $boardType, $safeData
     * 
     * 1. 게시글 생성
     * 2. 저장
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request = null)
    {
        try {
            DB::beginTransaction();

            $post = $this->boardType->create($this->safeData); // 게시글 저장 로직 ...

            DB::commit();

            return MyRes::res("글이 작성되었습니다.");
            // return response()->json(true);

        } catch (Exception $e) {
            DB::rollBack();
            return MyRes::err($e->getMessage());
            // return response()->json(false);
        }
    }
}
