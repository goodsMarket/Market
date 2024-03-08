<?php

namespace Database\Seeders;

use App\Models\Production;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Production::factory()->count(User::count() * 5)->create();
    }
}
