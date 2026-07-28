<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'nama'    => $this->faker->word(),
            'jenis'   => $this->faker->randomElement(['income', 'expense']),
        ];
    }
}
