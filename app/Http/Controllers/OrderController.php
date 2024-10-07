<?php

namespace App\Http\Controllers;

use App\Mail\OrderCreated;
use App\Repositories\OrderRepositoryInterface;
use App\Repositories\ClientRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    private $orderRepository;
    private $clientRepository;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        ClientRepositoryInterface $clientRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->clientRepository = $clientRepository;
    }

    public function index()
    {
        $orders = $this->orderRepository->read();
        return response()->json($orders);
    }

    public function show($id)
    {
        $order = $this->orderRepository->readOne($id);

        if (!($order instanceof Order)) {
            return response()->json($order, 404);
        }

        return response()->json($order);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'client_id' => 'required|exists:clients,client_id',
        ]);

        $order = $this->orderRepository->create($request->all());

        $client = $this->clientRepository->readOne($request->client_id);
        Mail::to($client->email)->send(new OrderCreated($client, $order));

        return response()->json($order, 201);
    }

    public function update(Request $request, $id)
    {
        $order = $this->orderRepository->readOne($id);

        if (!($order instanceof Order)) {
            return response()->json($order, 404);
        }

        $updated = $this->orderRepository->update($order, $request->all());

        if (!$updated) {
            return response()->json(['error' => 'Order has not been updated.'], 401);
        }

        return response()->json($order);
    }

    public function destroy($id)
    {
        $order = $this->orderRepository->readOne($id);

        if (!($order instanceof Order)) {
            return response()->json($order, 404);
        }

        $deleted = $this->orderRepository->delete($id);

        if (!$deleted) {
            return response()->json(['error' => 'Order has not been deleted.'], 401);
        }

        return response()->json(['message' => 'Order deleted']);
    }
}
