<?php

namespace Database\Factories;

use App\Models\User;
use App\Modules\MyModule;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BankAccount>
 */
class BankAccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $fk_time = MyModule::fakerTimeGenerate();

        $kor_bank = [
            'KEB하나은행',
            'SC제일은행',
            '국민은행',
            '신한은행',
            '외환은행',
            '우리은행',
            '한국시티은행',
            '지방은행',
            '경남은행',
            '광주은행',
            '대구은행',
            '부산은행',
            '전북은행',
            '제주은행',
            '특수은행',
            '기업은행',
            '농협',
            '수협',
            '한국산업은행',
            '한국수출입은행',
        ];

        $rand_u_id = User::inRandomOrder()->value('id');

        return [
            'u_id' => $rand_u_id,
            'ba_bank_name' => $this->faker->randomElement($kor_bank),
            'ba_account_num' => $this->faker->regexify('[0-9]{' . rand(11, 14) . '}'),
            'ba_account_owner' => User::find($rand_u_id)->u_name,
            'deleted_at' => rand(0,9) < 1 ? $fk_time['del'] : null,
        ];
    }
}
