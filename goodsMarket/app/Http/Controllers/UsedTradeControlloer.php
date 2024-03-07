<?php

namespace App\Http\Controllers;

use App\Models\UsedTrade;
use App\Modules\ImageModule;
use Illuminate\Http\Request;

class UsedTradeControlloer extends BoardController
{
    /**
     * 게시글 개별 출력 틀
     * 
     */
    protected function view_ut()
    {
        $this->indexEloquent = [
            // 출력개수 => 엘로퀀트 인스턴스,
            '16' => UsedTrade::class,
        ];
    }

    /**
     * 중고 작성
     * 
     * @param \Illuminate\Http\Request $request
     * $request에 보드 정보, 이미지 첨부 필요
     * return은 store:JsonResponse임
     */
    public function store_ut(Request $request)
    {
        // 작성할 컬럼
        $this->safeData = $request->only([
            'writer_id',
            'c_id',
            'ut_title',
            'ut_thumbnail',
            'ut_price',
            'ut_count',
            'ut_quality',
            'ut_description',
            'ut_refund',
        ]);

        // 작성할 모델
        $this->boardType = new UsedTrade();

        // 이미지관련 내용 넘겨주기
        $this->hasImageFile = $request->hasFile('images');
        $this->imageFile = $request->file('images');

        // 부모 틀 실행
        return $this->store();
    }

    /**
     * 게시글 수정 틀
     * 수정할 때는 확실히 글쓴이인지 확인하고 업데이트해야겠다 (남이 값싸게 바꿀 수 있지 않을까 with 카드결제)
     */
    protected function update_ut()
    {
        
    }

    /**
     * 게시글 삭제 틀
     * 
     */
    protected function delete_ut()
    {
        
    }
}
