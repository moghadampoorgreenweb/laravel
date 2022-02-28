<?php

namespace Database\Factories;

use App\Models\Email;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
//        return [
//            'email'=>$this->faker->email(),
//            'title'=>$this->faker->sentence(12),
//            'body'=>$this->faker->paragraph(2),
//            'status'=>$this->faker->randomElement([Email::STATUS_FAIL,Email::STATUS_DONE,Email::STATUS_PENDING,Email::STATUS_CANCEL]),
//        ];
        return [
            'email'=>$this->faker->email(),
            'title'=>$this->faker->sentence(15),
            'type'=>$this->faker->randomElement([Email::TYPE_LOGIN,Email::TYPE_INVOICE,Email::TYPE_WELCOME]),
            'status'=>$this->faker->randomElement([Email::STATUS_PENDING]),
        ];
    }
}
