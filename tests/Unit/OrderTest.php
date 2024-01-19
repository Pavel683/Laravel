<?php

namespace Tests\Unit;

use App\Models\Order;
//use PHPUnit\Framework\TestCase;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OrderTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */

    /**
     * Тестируем создание заказа, для которого создаем пользователя и продукт
     * Далее проверяем связь user модели Order
     */
    public function testOrderCreate() : void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();
//        $user = User::inRandomOrder()->first();
//        $product = Product::inRandomOrder()->first();  // Если нужно создавать из определенного и существующего списка
        $order = Order::factory()->create(['seller_id' => $user->id, 'email' => $user->email, 'product_id' => $product->id]);
        $this->assertEquals($user->id, $order->user->id);
    }

    public function testUserManyOrders() : void
    {
        $user = User::factory(3)->active()->
            has(Order::factory()->count(2))->
            create();
    }

}
