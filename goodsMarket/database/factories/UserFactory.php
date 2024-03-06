<?php

namespace Database\Factories;

use App\Models\User;
use App\Modules\MyModule;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\user>
 */
class UserFactory extends Factory
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
        $updated_at2 = $this->faker->dateTimeBetween($created_at, 'now');
        $deleted_at = $this->faker->dateTimeBetween($updated_at, 'now');

        return [
            'u_name' => $this->faker->name,
            'u_nickname' => $this->faker->unique()->word,
            'u_email' => $this->faker->unique()->safeEmail,
            // 'email_verified_at' => rand(0, 1) ? $fk_time['ver'] : null,
            'u_pw' => '$2y$10$TKhbr2ypdBCSMZ5ZVtbGeuQGZmrU5Rz3FulXFJxan3aG84BnC46Ii', // password
            'u_phone_num' => $this->faker->unique()->regexify('010-[0-9]{4}-[0-9]{4}'),
            'u_agree_flg' => '1',
            // 'remember_token' => Str::random(10),
            'created_at' => $created_at,
            'updated_at' => $updated_at,
            'deleted_at' => rand(0,9) < 1 ? $deleted_at : null,
        ];
    }
}
