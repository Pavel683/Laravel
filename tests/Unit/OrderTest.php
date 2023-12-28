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
//    use RefreshDatabase;
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
        $order = Order::factory()->create(['seller_id' => $user->id, 'email' => $user->email, 'product_id' => $product->id]);
        $this->assertEquals($user->id, $order->user->id);
    }

}
