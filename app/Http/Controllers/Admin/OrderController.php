<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));

        $orders = Order::with('user')
            ->withCount('items')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('code', 'like', "%{$search}%")
                        ->orWhere('status', 'like', "%{$search}%")
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
            'title' => 'Manage Orders',
            'orders' => $orders,
            'search' => $search,
        ];

        return view('admin.order.index', ['viewData' => $viewData]);
    }

    public function show(int $id): View
    {
        $order = Order::with(['user', 'items.product', 'payments'])->findOrFail($id);

        $viewData = [
            'title' => 'Order Details',
            'order' => $order,
            'canCancel' => $order->canBeCancelled(),
        ];

        return view('admin.order.show', ['viewData' => $viewData]);
    }

    public function cancel(int $id): RedirectResponse
    {
        $order = Order::findOrFail($id);

        if (! $order->cancel()) {
            return redirect()->route('admin.order.show', ['id' => $id])
                ->with('error', 'Este pedido ya no se puede cancelar.');
        }

        return redirect()->route('admin.order.show', ['id' => $id])
            ->with('success', 'Pedido cancelado. El pago fue reembolsado.');
    }
}
