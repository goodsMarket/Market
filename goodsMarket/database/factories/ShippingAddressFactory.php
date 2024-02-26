<?php

namespace Database\Factories;

use App\Models\User;
use App\Modules\MyModule;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ShippingAddress>
 */
class ShippingAddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $created_at = $this->faker->dateTimeBetween('-1 year', 'now');

        // 아파트 동, 층, 호를 생성합니다.
        $apartmentNumber = rand(1,5) . rand(0,1) . $this->faker->numberBetween(1, 9);
        $floor = $this->faker->numberBetween(1, 15);
        $room = $floor .'0'. $this->faker->numberBetween(1, 8);

        return [
            'u_id' => User::inRandomOrder()->value('id'),
            'sa_address_num' => $this->faker->postcode(),
            'sa_address' => $this->faker->address(),
            'sa_address_detail' => $apartmentNumber . '동 ' . $floor . '층 ' . $room.'호',
            'created_at' => $created_at,
        ];
    }
}
