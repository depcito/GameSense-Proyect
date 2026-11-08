<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\ImageStorage;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));

        $products = Product::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->orderBy('id')
            ->paginate(10)
            ->withQueryString();

        $viewData = [
            'title' => 'Manage Products',
            'products' => $products,
            'search' => $search,
        ];

        return view('admin.product.index', ['viewData' => $viewData]);
    }

    public function create(): View
    {
        $viewData = [
            'title' => 'Create Product',
            'categories' => Category::all(),
        ];

        return view('admin.product.create', ['viewData' => $viewData]);
    }

    public function save(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1000'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'format' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'platform' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $product = new Product;
        $product->setTitle($data['title']);
        $product->setDescription($data['description']);
        $product->setPrice($data['price']);
        $product->setStock($data['stock']);
        $product->setFormat($data['format']);
        $product->setType($data['type']);
        $product->setPlatform($data['platform']);
        $product->category_id = $data['category_id'];

        if ($request->hasFile('image')) {

            $imagePath = 'products/'.Str::uuid()
                .'.'.$request->file('image')->extension();

            $request->merge([
                'image_path' => $imagePath,
            ]);

            $imageStorage = app(ImageStorage::class);
            $imageStorage->store($request);

            $product->setImage($imagePath);
        }

        $product->save();

        return redirect()->route('admin.product.index')
            ->with('success', 'Producto creado correctamente.');
    }

    public function show(int $id): View
    {
        $viewData = [
            'title' => 'Product Details',
            'product' => Product::with('category')->findOrFail($id),
        ];

        return view('admin.product.show', ['viewData' => $viewData]);
    }

    public function edit(int $id): View
    {
        $viewData = [
            'title' => 'Edit Product',
            'product' => Product::findOrFail($id),
            'categories' => Category::all(),
        ];

        return view('admin.product.edit', ['viewData' => $viewData]);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1000'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'format' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'platform' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $product->setTitle($data['title']);
        $product->setDescription($data['description']);
        $product->setPrice($data['price']);
        $product->setStock($data['stock']);
        $product->setFormat($data['format']);
        $product->setType($data['type']);
        $product->setPlatform($data['platform']);
        $product->category_id = $data['category_id'];

        if ($request->hasFile('image')) {

            $imagePath = 'products/'.Str::uuid()
                .'.'.$request->file('image')->extension();

            $request->merge([
                'image_path' => $imagePath,
            ]);

            $imageStorage = app(ImageStorage::class);
            $imageStorage->store($request);

            $product->setImage($imagePath);
        }

        $product->save();

        return redirect()->route('admin.product.index')
            ->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.product.index')
            ->with('success', 'Producto eliminado correctamente.');
    }
}
