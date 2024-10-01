<?php

namespace App\Http\Controllers;

use App\Models\OrderProduct;
use Illuminate\Http\Request;

class OrderProductController extends Controller
{
    public function index()
    {
        return response()->json(OrderProduct::all());
    }

    public function show($orderId, $productId)
    {
        $orderProduct = OrderProduct::where('order_id', $orderId)
            ->where('product_id', $productId)
            ->first();

        if (!$orderProduct) {
            return response()->json(['error' => 'Order Product not found'], 404);
        }

        return response()->json($orderProduct);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'order_id' => 'required|exists:orders,order_id',
            'product_id' => 'required|exists:products,product_id',
        ]);

        $orderProduct = OrderProduct::create($request->all());

        return response()->json($orderProduct, 201);
    }

    public function update(Request $request, $orderId, $productId)
    {
        $orderProduct = OrderProduct::where('order_id', $orderId)
            ->where('product_id', $productId)
            ->first();

        if (!$orderProduct) {
            return response()->json(['error' => 'Order Product not found'], 404);
        }

        $orderProduct->update($request->all());

        return response()->json($orderProduct);
    }

    public function destroy($orderId, $productId)
    {
        $orderProduct = OrderProduct::where('order_id', $orderId)
            ->where('product_id', $productId)
            ->first();

        if (!$orderProduct) {
            return response()->json(['error' => 'Order Product not found'], 404);
        }

        $orderProduct->delete();

        return response()->json(['message' => 'Order Product deleted']);
    }
}
