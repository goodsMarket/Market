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
        // $rand = rand(1, 365);
        // $cre = now()->subDays($rand);
        // $rand1_1 = $rand - (rand(1, $rand));
        // $ver = now()->subDays($rand1_1);
        // $rand2 = $rand - (rand(1, $rand));
        // $upd = $cre->addDays($rand2);
        // $rand3 = $rand2 - (rand(1, $rand2));
        // $del = $upd->addDays($rand3);
        // $deleted = rand(0,9);

        $fk_time = MyModule::fakerTimeGenerate();

        return [
            'u_name' => $this->faker->name,
            'u_nickname' => $this->faker->unique()->word,
            'u_email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => rand(0, 1) ? $fk_time['ver'] : null,
            'u_pw' => '$2y$10$TKhbr2ypdBCSMZ5ZVtbGeuQGZmrU5Rz3FulXFJxan3aG84BnC46Ii', // password
            'u_phone_num' => $this->faker->unique()->regexify('010-[0-9]{4}-[0-9]{4}'),
            'u_agree_flg' => '1',
            // 'remember_token' => Str::random(10),
            'created_at' => $fk_time['cre'],
            'updated_at' => $fk_time['upd'],
            'deleted_at' => $fk_time['deleted'] === 0 ? $fk_time['del'] : null,
        ];
    }
}
