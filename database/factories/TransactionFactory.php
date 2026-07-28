<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition(): array
    {
        return [
            'user_id'     => User::factory(),
            'category_id' => Category::factory(),
            'judul'       => $this->faker->sentence(3),
            'jumlah'      => $this->faker->numberBetween(1000, 500000),
            'tanggal'     => now()->format('Y-m-d'),
            'jenis'       => $this->faker->randomElement(['income', 'expense']),
            'keterangan'  => $this->faker->sentence(),
        ];
    }
}
