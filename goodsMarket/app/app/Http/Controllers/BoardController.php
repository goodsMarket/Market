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
use Intervention\Image;
use Intervention\Image\Decoders\FilePathImageDecoder;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class BoardController extends Controller
{
    protected $imageModule;

    /**
     * 이미지 쓸거면 모듈 가지고 와라
     */
    public function __construct(ImageModule $imageModule = null)
    {
        $this->imageModule = $imageModule;
    }

    /**
     * 중고 작성
     */
    public function createUsedTrade(Request $request)
    {

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
            DB::beginTransaction();

            $post = UsedTrade::create($safeData); // 게시글 저장 로직 ...

            // 이미지 생성
            // 보드 작성 트랜잭션 안에 있으니 이미지 잘못 되어도 롤백 가능
            if ($request->hasFile('images')) {
                // 이미지 생성 후 썸네일 설정 (중고는 최상위)
                // 최상위 이미지를 압축해서 public/images/thumbnails로
                $firstImgPath = $this->imageModule->saveImages($request->file('images'), $post, 0); // 중고 0, 제작 1, 문의 2

                // 편집 드라이버 호출
                $manager = new ImageManager(Driver::class);

                // 이미지 인스턴스
                $image = $manager->read(public_path($firstImgPath), FilePathImageDecoder::class);

                // 크기 조절
                $image->resize(height: 300);

                // insert a watermark
                // $image->place('images/watermark.png');

                // 인스턴스 -> 이미지파일
                $encoded = $image->toJpg();

                // public/images/thumbnails 에따 저장
                $encoded->save(public_path('\\images\\thumbnails\\') . '.jpg');

                // post->thumbnail 값 바꾸고 저장
                $compressedImage = time() . $post->id . rand(000, 999) . '.jpg';
                $post->ut_thumbnail = '\\images\\thumbnails\\' . $compressedImage;
                $post->save();
            }

            if (trim($post->ut_thumbnail) === '') {
                throw new Exception('thumnail has not uploaded.');
            }

            DB::commit();

            // return redirect()->back()->with('success', '게시글이 성공적으로 저장되었습니다.')
            return response()->json(["message" => "글이 작성되었습니다."], 200);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    // 제작 작성

    // 중고 출력

    // 제작 출력

    // 중고 수정
    // 수정할 때는 확실히 글쓴이인지 확인하고 업데이트해야겠다 (남이 값싸게 바꿀 수 있지 않을까 with 카드결제)

    // 제작 수정

    // 중고/제작 삭제
}
