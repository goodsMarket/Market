<?php

namespace Database\Factories;

use App\Models\Board;
use App\Models\BoardImg;
use App\Models\UsedTrade;
use App\Modules\MyModule;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BoardImg>
 */
class BoardImgFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $created_at = $this->faker->dateTimeBetween('-1 year', 'now');

        // *파일경로
        $path = '\\images\\samples';

        // public 디렉토리 경로
        $publicPath = public_path($path);

        // public 디렉토리 내 파일들을 배열로 가져오기
        $files = scandir($publicPath);

        // . 및 ..을 배열에서 제거
        $files = array_diff($files, array('..', '.'));

        // *없는 애들한테 달아주기

        // 모델을 이용하여 존재하는 값 목록 가져오기
        $existingValues = BoardImg::pluck('board_id')->toArray();

        // 존재하지 않는 값 필터링하여 선택
        $missingValues = UsedTrade::select('id')->whereNotIn('id', $existingValues)->get();
        foreach ($missingValues as $key => $value) {
            $missings[] = $value->id;
        }

        return [
            // 'bi_board_flg' => rand(0),
            'bi_board_flg' => 0,
            'board_id' => empty($missings) ? UsedTrade::inRandomOrder()->value('id') : $missings[array_rand($missings)],
            'bi_img_path' => $path . '\\' .$files[array_rand($files)],
            'created_at' => $created_at,
        ];
    }
}
