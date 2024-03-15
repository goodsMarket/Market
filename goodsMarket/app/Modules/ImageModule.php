<?php
namespace App\Modules;

use App\Models\BoardImg;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Intervention\Image\Decoders\FilePathImageDecoder;

class ImageModule
{
    /**
     * 이미지 주면 board_imgs에 저장함
     * 
     * @param array $images 하나든지 한개든지
     * @param object $post 중고, 제작
     * @param int $boardType 중고0, 제작1, 문의2
     * 
     * @return string|\Illuminate\Http\JsonResponse 최상위 이미지 주소 반환 (중고용)
     */
    public static function saveImages($images, $post, $boardType)
    {
        $uploadedImages = [];
        $first = true;
        $firstImagePath = '';
        
        // public/images에 저장
        foreach ($images as $image) {
            // $path = $image->store('public/images');
            // $post->images()->create(['image_path' => $path]);
            $imageName = time() . rand(100, 999) . '.' . $image->extension();
            $path = $image->move(public_path('images'), $imageName);
            // 그냥 넣으면 서버 폴더 위치 다나옴 ㄷㄷ
            $uploadedImages[] = strstr($path, "images");
        }

        // 저장된 애들을 각각 레코드에 작성
        try {
            foreach($uploadedImages as $uploadedImage){
                $result = BoardImg::create([
                    'bi_board_flg' => $boardType,
                    'board_id' => $post->id,
                    'bi_img_path' => $uploadedImage,
                ]);

                // 최상위 이미지 주소 반환 (중고)
                if($first){
                    $firstImagePath = $result->bi_img_path;
                    $first = false;
                }
            }

            return $firstImagePath;
        } catch (Exception $e) {
            DB::rollBack();
            return MyRes::err($e->getMessage());
        }
    }

    /**
     * 이미지 주면 board_imgs에 저장함
     * 
     * @param object $post 중고, 제작
     * @param string $firstImgPath 썸네일 주소
     */
    public static function saveThumb($post, $firstImgPath)
    {
        // 편집 드라이버 호출
        $manager = new ImageManager(Driver::class);
                
        // 이미지 인스턴스
        $image = $manager->read(public_path($firstImgPath), FilePathImageDecoder::class);

        // 크기 조절
        $image->resize(height: 300);

        // 인스턴스 -> 이미지파일
        $encoded = $image->toJpg();

        // public/images/thumbnails 에따 저장
        $compressedImage = time() . $post->id . rand(000, 999) . '.jpg';
        $encoded->save(public_path('\\images\\thumbnails\\') . $compressedImage);

        // post->thumbnail 값 바꾸고 저장
        $post->ut_thumbnail = '\\images\\thumbnails\\' . $compressedImage;
        $post->save();
    }
}