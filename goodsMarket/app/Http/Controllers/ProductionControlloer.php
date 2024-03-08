<?php

namespace App\Http\Controllers;

use App\Models\UsedTrade;
use App\Models\Production;
use App\Modules\ImageModule;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductionControlloer extends BoardController
{
    // used_trades의 손댈곳
    private array $only = [
        'u_id',
        'c_id',
        'p_title',
        'p_start_date',
        'p_end_date',
        'p_schedule',
        'p_content',
        'p_age_limit',
        'p_password',
        'p_thumbnail',
        'p_notice_agreement',
        'p_twitter',
        'p_instagram',
        'p_question',
    ];

    /**
     * 적용 엘로퀀트 정의
     */
    public function __construct()
    {
        $this->boardType = new Production();
    }

    /**
     * 게시글 개별 출력
     * 
     * @param int $id
     */
    public function view_p($id)
    {
        $this->boardId = $id;

        return $this->view();
    }

    /**
     * 중고 작성
     * 
     * @param \Illuminate\Http\Request $request
     * $request에 보드 정보, 이미지 첨부 필요
     */
    public function store_p(Request $request)
    {
        // 작성할 컬럼
        $this->safeData = $request->only($this->only);

        // 이미지관련 내용 넘겨주기
        $this->hasImageFile = $request->hasFile('images');
        $this->imageFile = $request->file('images');

        // 부모 틀 실행
        return $this->store();
    }

    /**
     * 게시글 수정
     * 
     * @param \Illuminate\Http\Request
     */
    public function update_p(Request $request)
    {
        $this->safeData = $request->only($this->only);

        return $this->update();
    }

    /**
     * 게시글 삭제
     * 
     * @param \Illuminate\Http\Request $request
     * $request = { id:int }
     */
    public function delete_p(Request $request)
    {
        $this->boardId = $request->id;
        $this->cookie = $request->cookie('user_id');

        return $this->delete();
    }
    
    /**
     * 삭제된 게시글 개별 출력
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     */
    public function view_deleted_p(Request $request)
    {
        $this->cookie = $request->cookie('user_id');
        $this->boardId = $request->input('id');

        return $this->view_deleted();
    }
}
