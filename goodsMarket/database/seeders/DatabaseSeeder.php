<?php

use App\Models\ShippingAddress;
use Database\Factories\UserFactory;
use Database\Seeders\BankAccountSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ShippingAddressSeeder;
use Database\Seeders\UsedTradeSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            CategorySeeder::class,
            UserSeeder::class,
            ShippingAddressSeeder::class,
            BankAccountSeeder::class,
            UsedTradeSeeder::class,
        ]);
    }
}