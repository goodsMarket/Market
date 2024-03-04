<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $major = [
            '굿즈 양도',
            '제작 판매',
        ];

        $sub = [
            '인형',
            '게임',
            '창작',
            '유튜버',
            '피규어/스탠드',
            '애니/만화',
            '웹툰/웹소설',
            '버츄얼',
            '아이돌',
            '배우',
            '영화/드라마',
            '뮤지컬',
            '이모티콘 캐릭터',
        ];

        $detail = [
            '그림',
            '사진',
            '소품',
        ];
        
        foreach($major as $key => $m){
            foreach($sub as $key => $s){
                foreach($detail as $key => $d){
                    Category::create([
                        // 대분류, 장르, 랜덤문자열 일단 넣기
                        'c_major' => $m,
                        'c_sub' => $s,
                        'c_detail' => $d,
                    ]);
                }
            }
        }
    }
}
