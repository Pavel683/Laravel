<?php

namespace Tests\Unit;

use App\Models\Product;
//use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
//    use RefreshDatabase;
    /**
     * A basic unit test example.
     */

    public function testProductCreate() : void
    {
        $product = Product::factory()->create();
        $this->assertTrue(true);
    }
}
