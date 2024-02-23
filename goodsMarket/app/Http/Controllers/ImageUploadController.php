<?php

namespace App\Http\Controllers;

use App\Models\BoardImg;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImageUploadController extends Controller
{
    /**
     * 이미지 업로드 쇼잉
     */
    public function index()
    {
        return view('image-upload');
    }

    /**
     * 이미지 저장 메소드
     * 
     * jpeg,png,jpg,gif,svg
     * @param Request $request->이미지
     */
    public function store(Request $request)
    {
        $message = '';

        try {
            $i = 0;
            while (true) {
                // request 안에 image라는 이름을 가진 객체?배열을 오고
                if ($request->has('image' . $i)) {
                    // 이걸 돌리면서 (if) 이미지를 등록하면 되고
                    $imageName = time() . rand(100, 999) . '.' . $request->input('image' . $i)->extension();
                    $request->input('image' . $i)->move(public_path('images'), $imageName);

                    // 글 검사, 이미지 검사(mid) -> 글 등록(con) ->route(이미지 저장 -> 이미지 레코드 등록)
                    // 임시 저장 후 레코드 등록 후엔 삭제하기, 6시간마다 임시저장 폴더 비우기

                    BoardImg::create([
                        'bi_board_flg' => '',
                        'board_id' => '',
                        'bi_img_path' => '',
                    ]);

                } else {
                    break;
                }
                $i++;
            }

            if ($request->has('image' . ($i - 1))) {
                $message = "The post and image upload has succeeded";
            } else {
                $message = "The post upload has succeeded";
            }

        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ]);
        }

        return response()->json([
            'message' => $message,
        ], 200);

    }
}