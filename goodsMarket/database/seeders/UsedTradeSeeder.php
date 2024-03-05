<?php

namespace Database\Seeders;

use App\Models\UsedTrade;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsedTradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // UsedTrade::factory()->count(1)->create();
        UsedTrade::factory()->count(User::count() * 20)->create();
    }
}
