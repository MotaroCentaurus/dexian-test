<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

class OrderRepository implements OrderRepositoryInterface
{
    public function create(array $params): Order
    {
        return Order::create($params);
    }

    public function read(): Collection
    {
        return Order::with('products')->get();
    }

    public function readOne(int $id): Order | array
    {
        $order = Order::with('products')->find($id);

        if (!$order) {
            return ['error' => 'Order not found'];
        }

        return $order;
    }

    public function update(Order $order, array $params): bool | array
    {
        if (!($order instanceof Order)) {
            return ['error' => 'Order not found'];
        }

        return $order->update($params);
    }

    public function delete(int $id): bool | array
    {
        $order = Order::find($id);

        if (!$order) {
            return ['error' => 'Order not found'];
        }

        return $order->delete();
    }
}
