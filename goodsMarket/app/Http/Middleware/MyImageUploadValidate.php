<?php

namespace App\Http\Middleware;

use App\Modules\ValidatorList;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MyImageUploadValidate
{
    /**
     * 이미지 정보를 유효성 검사후 패스 or 오류
     *
     * @param  Request $request 안에 이미지값
     * @param  Closure
     * @return Response|RedirectResponse 성공 후 다음작업 | 오류 반환
     */
    public function handle(Request $request, Closure $next)
    {
        // 글 검사, 이미지 검사 -> 글 등록 -> 이미지 저장 -> 이미지 레코드 등록
        // 임시 저장 후 레코드 등록 후엔 삭제하기, 6시간마다 임시저장 폴더 비우기
        // $imageName = time() . rand(100, 999) . '.' . $request->input('image' . $i)->extension();
        // $request->input('image' . $i)->move(public_path('images'), $imageName);
        $comparableValue = [];

        $i = 1;
        while (true) {
            if ($request->has('image' . $i)) {
                $comparableValue[] = ["image" . $i => ValidatorList::$image];
            } else {
                break;
            }
            $i++;
        }

        // 유효성 검사
        $validator = Validator::make($request->all(), $comparableValue);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        return $next($request)->with();
    }
}
