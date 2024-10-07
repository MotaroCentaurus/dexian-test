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

    public function testOrderrderCanBeCreated()
    {
        $order = Order::factory()->create();
        $foundOrder = Order::find($order->order_id);

        $this->assertNotNull($order);
        $this->assertNotNull($foundOrder);
        $this->assertEquals($order->order_id, $foundOrder->order_id);
    }

    public function testOrderCanBeUpdated()
    {
        $order = Order::factory()->create();
        $newClient = Client::factory()->create();

        $order->update(['client_id' => $newClient->client_id]);

        $foundOrder = Order::find($order->order_id);

        $this->assertEquals($foundOrder->client_id, $newClient->client_id);
    }

    public function testOrderCanBeRead()
    {
        $order = Order::factory()->create();

        $foundOrder = Order::find($order->order_id);

        $this->assertEquals($order->client_id, $foundOrder->client_id);
    }

    public function testOrderCanBeDeleted()
    {
        $order = Order::factory()->create();

        $order->delete();

        $foundOrder = Order::find($order->order_id);

        $this->assertEmpty($foundOrder);
    }
}
