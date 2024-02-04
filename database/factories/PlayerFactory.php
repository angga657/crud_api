<?php

namespace Database\Factories;

use App\Models\Player;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Player>
 */
class PlayerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = player::class;
    public function definition()
    {
        return [
            //
            'nickname' => $this->faker->name(),
            'username' => $this->faker->username(),
            'email' => $this->faker->email(),
        ];
    }
}
