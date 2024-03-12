<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use App\Modules\FilesInDirectory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\production>
 */
class ProductionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // 날짜
        $created_at = $this->faker->dateTimeBetween('-1 year', 'now');
        $start_at = $this->faker->dateTimeBetween($created_at, 'now');
        $end_at = $this->faker->dateTimeBetween($start_at, 'now');
        $updated_at = $this->faker->dateTimeBetween($created_at, 'now');
        $deleted_at = $this->faker->dateTimeBetween($updated_at, 'now');
        
        // 랜덤 유저, 썸네일
        $u_rand = User::find(rand(1, User::count()));
        $fileList = new FilesInDirectory(public_path('\\images\\thumbnail_samples'));
        $rand_img = array_rand($fileList->fileNames);

        // * 랜덤 제목
        // 파일 경로
        $filePath = public_path('\\images\\samples\\title_sample.txt');

        // 파일 내용을 배열로 읽어오기
        $file = File::get($filePath);
        $lines = explode("\n", $file);

        // 배열에서 랜덤한 인덱스 선택
        $randomIndex = array_rand($lines);

        // 랜덤한 줄 선택
        $randomLine = $lines[$randomIndex];

        return [
            'writer_id' => User::inRandomOrder()->value('id'),
            'c_id' => Category::inRandomOrder()->value('id'),
            // 'ut_title' => Str::limit($this->faker->sentence, 50),
            'p_title' => $randomLine,
            'p_start_date' => $start_at,
            'p_end_date' => $end_at,
            'p_schedule' => rand(1,14),
            'p_content' => $this->faker->text(1000),
            'p_age_limit' => rand(0,9) > 8 ? 1 : 0,
            'p_password' => 'Rntwmakzpt123!',
            'p_thumbnail' => '\\images\\thumbnail_samples\\' . $fileList->fileNames[$rand_img], // public/images/thumbnail_samples 중 랜덤 선택
            'p_notice_agreement' => rand(0,9) > 8 ? 1 : 0,
            'p_question' => $this->faker->text(255),
            'p_view' => rand(0, 100),
            'p_like' => rand(0, 1500),
            'created_at' => $created_at,
            'updated_at' => $updated_at,
            'deleted_at' => rand(0,9) < 1 ? $deleted_at : null,
        ];
    }
}
