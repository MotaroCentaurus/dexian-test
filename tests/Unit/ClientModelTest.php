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

    public function test_client_can_be_created()
    {
        $client = Client::factory()->create();
        $foundClient = Client::find($client->client_id);

        $this->assertNotNull($client);
        $this->assertNotNull($foundClient);
        $this->assertEquals($client->client_id, $foundClient->client_id);
    }

    public function test_client_can_be_updated()
    {
        $client = Client::factory()->create();

        $client->update(['client_name' => 'Updated Name']);

        $foundClient = Client::find($client->client_id);

        $this->assertEquals($foundClient->client_name, 'Updated Name');
    }

    public function test_client_can_be_read()
    {
        $client = Client::factory()->create();

        $foundClient = Client::find($client->client_id);

        $this->assertEquals($client->client_name, $foundClient->client_name);
    }

    public function test_client_can_be_deleted()
    {
        $client = Client::factory()->create();

        $client->delete();

        $foundClient = Client::find($client->client_id);

        $this->assertEmpty($foundClient);
    }

}
