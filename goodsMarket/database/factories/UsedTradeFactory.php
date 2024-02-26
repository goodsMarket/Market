<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use App\Modules\FilesInDirectory;
use App\Modules\MyModule;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UsedTrade>
 */
class UsedTradeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $created_at = $this->faker->dateTimeBetween('-1 year', 'now');
        $updated_at = $this->faker->dateTimeBetween($created_at, 'now');
        $deleted_at = $this->faker->dateTimeBetween($updated_at, 'now');
        
        $u_rand = User::find(rand(1, User::count()));
        $fileList = new FilesInDirectory(public_path('\\images\\thumbnail_samples'));
        $rand_img = array_rand($fileList->fileNames);

        return [
            'writer_id' => $u_rand->id,
            'c_id' => Category::inRandomOrder()->value('id'),
            'ut_title' => Str::limit($this->faker->sentence, 50),
            'ut_thumbnail' => '\\images\\thumbnail_samples\\' . $fileList->fileNames[$rand_img], // public/images/thumbnail_samples 중 랜덤 선택
            'ut_price' => rand(1, 999) . '000',
            'ut_count' => rand(0, 1) !== 0 ? rand(2, 50) : 1,
            'ut_quality' => rand(0, 4), // 품질 0~4 높을 수록 후짐
            'ut_description' => Str::limit($this->faker->sentence, rand(200, 1000)),
            'ut_refund' => rand(0, 1),
            'created_at' => $created_at,
            'updated_at' => $updated_at,
            'deleted_at' => rand(0,9) < 1 ? $deleted_at : null,
        ];
    }
}
