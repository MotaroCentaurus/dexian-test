<?php

namespace Tests\Unit;

use App\Models\Client;
use App\Models\Order;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\TestCase;


class ClientModelTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    public function testClientHasManyOrders()
    {
        $client = Client::factory()->create();
        $order = Order::factory()->create(['client_id' => $client->client_id]);

        $this->assertInstanceOf(Order::class, $client->orders->first());
    }

    public function testClientCreation()
    {
        $client = Client::factory()->create();
        $foundClient = Client::find($client->client_id);

        $this->assertNotNull($client);
        $this->assertNotNull($foundClient);
        $this->assertEquals($client->client_id, $foundClient->client_id);
    }

}
