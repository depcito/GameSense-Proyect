<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReviewController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));

        $reviews = Review::with(['user', 'product'])
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('comment', 'like', "%{$search}%")
                        ->orWhereHas('product', function ($product) use ($search) {
                            $product->where('title', 'like', "%{$search}%");
                        })
                        ->orWhereHas('user', function ($user) use ($search) {
                            $user->where('name', 'like', "%{$search}%")
                                ->orWhere('email', 'like', "%{$search}%");
                        });
                });
            })
            ->latest('date')
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        $viewData = [
            'title' => __('controllers/Admin/ReviewController.title.index'),
            'reviews' => $reviews,
            'search' => $search,
        ];

        return view('admin.review.index', ['viewData' => $viewData]);
    }

    public function destroy(int $id): RedirectResponse
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->route('admin.review.index')
            ->with('success', __('controllers/Admin/ReviewController.deleted'));
    }
}
