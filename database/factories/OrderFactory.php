<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "seller_id" => User::factory()->create()->id,
            "telephone" => $this->faker->phoneNumber(),
            "email" => User::factory()->create()->email,
            "product_id" => Product::factory()->create()->id,

        ];
    }
}


//  Задать конкретные параметры
//            ->state([
//                'is_admin' => 1,
//                'is_active' => 0,
//            ])
