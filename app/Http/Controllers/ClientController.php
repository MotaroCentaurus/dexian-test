<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::with('orders.products')->get();
        return response()->json($clients);
    }

    public function show($id)
    {
        $client = Client::with('orders.products')->find($id);

        if (!$client) {
            return response()->json(['error' => 'Client not found'], 404);
        }

        return response()->json($client);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'client_name' => 'required|string|max:255',
            'email' => 'required|email',
            'telephone' => 'required|string',
        ]);

        $client = Client::create($request->all());

        return response()->json($client, 201);
    }

    public function update(Request $request, $id)
    {
        $client = Client::find($id);

        if (!$client) {
            return response()->json(['error' => 'Client not found'], 404);
        }

        $client->update($request->all());

        return response()->json($client);
    }

    public function destroy($id)
    {
        $client = Client::find($id);

        if (!$client) {
            return response()->json(['error' => 'Client not found'], 404);
        }

        $client->delete();

        return response()->json(['message' => 'Client deleted']);
    }
}
