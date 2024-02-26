<?php

namespace Database\Factories;

use App\Models\Board;
use App\Modules\MyModule;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
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

        // 이미지 파일 목록 조회
        $files = Storage::disk('public')->files('images\\samples');

        // 랜덤 파일 선택
        $randomFile = Arr::random($files);

        // 선택된 파일의 URL 생성
        $url = Storage::disk('public')->url($randomFile);

        return [
            'bi_board_flg' => rand(0,1),
            'board_id' => Board::inRandomOrder()->value('id'),
            'bi_img_path' => $url,
            'created_at' => $created_at,
        ];
    }
}
