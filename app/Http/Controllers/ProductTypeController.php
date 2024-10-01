<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    public function index()
    {
        return response()->json(ProductType::all());
    }

    public function show($id)
    {
        $productType = ProductType::find($id);

        if (!$productType) {
            return response()->json(['error' => 'Product type not found'], 404);
        }

        return response()->json($productType);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'product_type' => 'required|string|max:255',
        ]);

        $productType = ProductType::create($request->all());

        return response()->json($productType, 201);
    }

    public function update(Request $request, $id)
    {
        $productType = ProductType::find($id);

        if (!$productType) {
            return response()->json(['error' => 'Product type not found'], 404);
        }

        $productType->update($request->all());

        return response()->json($productType);
    }

    public function destroy($id)
    {
        $productType = ProductType::find($id);

        if (!$productType) {
            return response()->json(['error' => 'Product type not found'], 404);
        }

        $productType->delete();

        return response()->json(['message' => 'Product type deleted']);
    }
}
