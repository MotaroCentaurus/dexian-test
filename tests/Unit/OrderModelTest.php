<?php

namespace Tests\Unit;

use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\TestCase;


class OrderModelTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function testOrderBelongsToClient()
    {
        $order = Order::factory()->create();
        $this->assertInstanceOf(Client::class, $order->client);
    }

    public function testOrderHasManyProducts()
    {
        $order = Order::factory()->create();
        $product = Product::factory()->create();
        $order->products()->attach($product->product_id);

        $this->assertInstanceOf(Product::class, $order->products->first());
    }

}
