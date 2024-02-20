<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BoardController extends Controller
{
    // 중고 작성
    public function createUsedTrade(Request $request){
        // 리퀘스트로 *사진, *품명, *카테고리, *가격, *개수, 설명, 해시태그(이후버전), *거래방법, *환불 값을 받아서 제작
        // 그럼 그 전에 값이 제대로 왔는지 체크해야할듯 -> middleware:BoardValidate

        return response()->json(["message" => "글이 작성되었습니다."],200);
    }
    
    // 제작 작성

    // 중고 출력

    // 제작 출력

    // 중고 수정
    // 수정할 때는 확실히 글쓴이인지 확인하고 업데이트해야겠다 (남이 값싸게 바꿀 수 있지 않을까 with 카드결제)

    // 제작 수정

    // 중고/제작 삭제
}
