<?php

namespace App\Repositories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Collection;

class ClientRepository implements ClientRepositoryInterface
{
    public function create($params) : Client
    {
        return Client::create($params);
    }

    public function read() : Collection
    {
        return Client::with('orders.products')->get();
    }

    public function readOne($id) : Client | Array
    {
        $client = Client::with('orders.products')->find($id);

        if (!$client) {
            return ['error' => 'Client not found'];
        }

        return $client;
    }

    public function update(Client $client, Array $params) : bool | Array
    {
        if (!($client instanceof Client)) {
            return ['error' => 'Client not found'];
        }

        return $client->update($params);
    }

    public function delete(int $id) : bool | Array
    {
        $client = Client::find($id);

        if (!$client) {
            return response()->json(['error' => 'Client not found'], 404);
        }

        return $client->delete();
    }
}
