<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ReviewController extends Controller
{
    /**
     * List reviews. If ?product_id=X is sent, only that product's reviews are shown.
     */
    public function index(Request $request): View
    {
        $query = Review::with(['user', 'product'])->latest('date')->latest('id');
        $product = null;

        if ($request->filled('product_id')) {
            $product = Product::findOrFail($request->input('product_id'));
            $query->where('product_id', $product->getId());
        }

        $viewData = [
            'title' => 'Reseñas',
            'reviews' => $query->get(),
            'product' => $product,
        ];

        return view('review.index', ['viewData' => $viewData]);
    }

    public function create(Request $request): View
    {
        $viewData = [
            'title' => 'Crear reseña',
            'products' => Product::all(),
            'selectedProductId' => $request->input('product_id'),
        ];

        return view('review.create', ['viewData' => $viewData]);
    }

    public function save(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'rating' => ['required', 'integer', 'between:1,5'],
            'comment' => ['required', 'string', 'max:1000'],
            'product_id' => ['required', 'integer', 'exists:products,id'],
        ]);

        $review = new Review;

        $review->setRating($validated['rating']);
        $review->setComment($validated['comment']);
        $review->setDate(now()->toDateString());

        $review->user_id = Auth::id();
        $review->product_id = $validated['product_id'];

        $review->save();

        return redirect()->route('review.index', ['product_id' => $validated['product_id']]);
    }

    public function show(int $id): View
    {
        $viewData = [
            'title' => 'Detalle de la reseña',
            'review' => Review::with(['user', 'product'])->findOrFail($id),
        ];

        return view('review.show', ['viewData' => $viewData]);
    }

    /**
     * Only the author of the review (or an admin) can delete it.
     */
    public function delete(int $id): RedirectResponse
    {
        $review = Review::findOrFail($id);
        $user = Auth::user();

        abort_unless(
            $review->user_id === $user->getId() || $user->getRole() === 'admin',
            403
        );

        $productId = $review->product_id;
        $review->delete();

        return redirect()->route('review.index', ['product_id' => $productId]);
    }
}
