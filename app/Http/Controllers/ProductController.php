<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json(Product::all());
    }

    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        return response()->json($product);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'product_type_id' => 'required|integer',
            'product_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');

            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/products', $fileName, 'public');

            $product = Product::create([
                'product_type_id' => $request->input('product_type_id'),
                'product_name' => $request->input('product_name'),
                'price' => $request->input('price'),
                'photo' => $filePath
            ]);

            return response()->json($product, 201);
        }

        return response()->json(['message' => 'Image upload failed'], 400);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $product->update($request->all());

        return response()->json($product);
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted']);
    }
}
