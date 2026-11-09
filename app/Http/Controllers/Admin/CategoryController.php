<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\ImageStorage;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));

        $categories = Category::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->orderBy('id')
            ->paginate(10)
            ->withQueryString();

        $viewData = [
            'title' => __('controllers/Admin/CategoryController.title.index'),
            'categories' => $categories,
            'search' => $search,
        ];

        return view('admin.category.index', ['viewData' => $viewData]);
    }

    public function create(): View
    {
        $viewData = [
            'title' => __('controllers/Admin/CategoryController.title.create'),
        ];

        return view('admin.category.create', ['viewData' => $viewData]);
    }

    public function save(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:categories,name'],
            'description' => ['required', 'string', 'max:1000'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $category = new Category;
        $category->setName($data['name']);
        $category->setDescription($data['description']);

        if ($request->hasFile('image')) {

            $imagePath = 'categories/'.Str::uuid()
                .'.'.$request->file('image')->extension();

            $request->merge([
                'image_path' => $imagePath,
            ]);

            $imageStorage = app(ImageStorage::class);
            $imageStorage->store($request);

            $category->setImage($imagePath);
        }

        $category->save();

        return redirect()->route('admin.category.index')
            ->with('success', __('controllers/Admin/CategoryController.created'));
    }

    public function show(int $id): View
    {
        $viewData = [
            'title' => __('controllers/Admin/CategoryController.title.show'),
            'category' => Category::with('products')->findOrFail($id),
        ];

        return view('admin.category.show', ['viewData' => $viewData]);
    }

    public function edit(int $id): View
    {
        $viewData = [
            'title' => __('controllers/Admin/CategoryController.title.edit'),
            'category' => Category::findOrFail($id),
        ];

        return view('admin.category.edit', ['viewData' => $viewData]);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $category = Category::findOrFail($id);

        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:categories,name,'.$category->getId(),
            ],
            'description' => ['required', 'string', 'max:1000'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $category->setName($data['name']);
        $category->setDescription($data['description']);

        if ($request->hasFile('image')) {

            $imagePath = 'categories/'.Str::uuid()
                .'.'.$request->file('image')->extension();

            $request->merge([
                'image_path' => $imagePath,
            ]);

            $imageStorage = app(ImageStorage::class);
            $imageStorage->store($request);

            $category->setImage($imagePath);
        }

        $category->save();

        return redirect()->route('admin.category.index')
            ->with('success', __('controllers/Admin/CategoryController.updated'));
    }

    public function destroy(int $id): RedirectResponse
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.category.index')
            ->with('success', __('controllers/Admin/CategoryController.deleted'));
    }
}
