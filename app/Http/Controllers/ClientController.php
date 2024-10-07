<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Repositories\ClientRepositoryInterface;

class ClientController extends Controller
{
    private $clientRepository;

    public function __construct(ClientRepositoryInterface $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function index()
    {
        $clients = $this->clientRepository->read();
        return response()->json($clients);
    }

    public function show($id)
    {
        $result = $this->clientRepository->readOne($id);

        if (!($result instanceof Client)) {
            return response()->json($result, 404);
        }

        return response()->json($result);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'client_name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients',
            'telephone' => 'required|string',
        ]);

    $result = $this->clientRepository->create($request->all());

        if (!($result instanceof Client)) {
            return response()->json($result, 401);
        }

        return response()->json($result, 201);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'client_name' => 'string|max:255',
            'email' => 'email|unique:clients',
            'telephone' => 'string',
        ]);

        $client = $this->clientRepository->readOne($id);

        if (!($client instanceof Client)) {
            return response()->json($client, 404);
        }

        $hasBeenUpdated = $this->clientRepository->update($client, $request->all());

        if (!$hasBeenUpdated) {
            return response()->json(['error' => 'Client has not been updated.'], 401);
        }

        return response()->json($client);
    }

    public function destroy($id)
    {
        $client = $this->clientRepository->readOne($id);

        if (!($client instanceof Client)) {
            return response()->json($client, 404);
        }

        $hasBeenDeleted = $this->repository->delete($id);

        if (!$hasBeenDeleted) {
            return response()->json(['error' => 'Client has not been deleted.'], 401);
        }

        return response()->json(['message' => 'Client deleted']);
    }
}
