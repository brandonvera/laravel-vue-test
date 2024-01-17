<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Quote;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quote>
 */
class QuoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'quote' => $this->faker->sentence(),
            'author' => $this->faker->name(),
            'user_id' => User::factory(),
        ];
    }
}
