<?php

namespace App\Http\Controllers;

use App\Models\UsedTrade;
use App\Modules\MyModule;
use App\Modules\ImageModule;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class BoardController extends Controller
{
    protected $imageModule;

    public function __construct(ImageModule $imageModule)
    {
        $this->imageModule = $imageModule;
    }

    // 중고 작성
    public function createUsedTrade(Request $request){

        // 적용할 컬럼
        $safeData = $request->only([
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

        try {
            $post = UsedTrade::create($safeData); // 게시글 저장 로직 ...
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['message'=>$e->getMessage()]);
        }

        // 이미지 생성
        // Log::debug($request);
        if ($request->hasFile('images')) {
            $this->imageModule->saveImages($request->file('images'), $post, 0); // 중고 0, 제작 1, 문의 2
        }

        // return redirect()->back()->with('success', '게시글이 성공적으로 저장되었습니다.')
        return response()->json(["message" => "글이 작성되었습니다.".$post],200);
    }
    
    // 제작 작성

    // 중고 출력

    // 제작 출력

    // 중고 수정
    // 수정할 때는 확실히 글쓴이인지 확인하고 업데이트해야겠다 (남이 값싸게 바꿀 수 있지 않을까 with 카드결제)

    // 제작 수정

    // 중고/제작 삭제
}
