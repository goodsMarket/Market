<?php
namespace App\Modules;

use App\Models\BoardImg;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ImageModule
{
    public function saveImages($images, $post, $boardType)
    {
        $uploadedImages = [];

        // public/images에 저장
        foreach ($images as $image) {
            // $path = $image->store('public/images');
            // $post->images()->create(['image_path' => $path]);
            $imageName = time() . rand(100, 999) . '.' . $image->extension();
            $path = $image->move(public_path('images'), $imageName);
            $uploadedImages[] = $path;
        }

        // 저장된 애들을 각각 레코드에 작성
        try {
            foreach($uploadedImages as $uploadedImage){
                BoardImg::create([
                    'bi_board_flg' => $boardType,
                    'board_id' => $post->id,
                    'bi_img_path' => $uploadedImage,
                ]);
            }
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['message' => $e->getMessage()]);
        }
    }
}