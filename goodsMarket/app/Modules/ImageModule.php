<?php
namespace App\Modules;

use App\Models\BoardImg;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ImageModule
{
    /**
     * 이미지 주면 board_imgs에 저장함
     * 
     * @param array $images 하나든지 한개든지
     * @param object $post 중고, 제작
     * @param int $boardType 중고0, 제작1, 문의2
     * 
     * @return string 최상위 이미지 주소 반환 (중고용)
     */
    public function saveImages($images, $post, $boardType)
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
            return response()->json(['message' => $e->getMessage()]);
        }
    }
}