<?php

namespace Database\Seeders;

use App\Models\BoardImg;
use App\Models\UsedTrade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BoardImgSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BoardImg::factory()->count(ceil((UsedTrade::count())*3.4))->create();
        // BoardImg::factory()->count(ceil((UsedTrade::count())))->create();
        // BoardImg::factory()->count(1)->create();
    }
}
