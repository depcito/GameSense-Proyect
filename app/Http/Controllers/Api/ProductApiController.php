<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductApiController extends Controller
{
    public function index(): JsonResponse
    {
        $products = ProductResource::collection(
            Product::with('category')->get()
        );

        return response()->json($products, 200);
    }

    public function show(int $id): JsonResponse
    {
        $product = new ProductResource(
            Product::with('category')->findOrFail($id)
        );

        return response()->json($product, 200);
    }
}