<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * List the orders placed by the authenticated user.
     */
    public function index(): View
    {
        $viewData = [
            'title' => 'Pedidos',
            'orders' => Order::withCount('items')
                ->where('user_id', Auth::id())
                ->latest('date')
                ->latest('id')
                ->get(),
        ];

        return view('order.index', ['viewData' => $viewData]);
    }

    public function show(int $id): View
    {
        $order = Order::with(['items.product', 'payments'])->findOrFail($id);

        $this->authorizeAccess($order);

        $viewData = [
            'title' => 'Detalle del pedido',
            'order' => $order,
            'canCancel' => $order->canBeCancelled(),
        ];

        return view('order.show', ['viewData' => $viewData]);
    }

    public function cancel(int $id): RedirectResponse
    {
        $order = Order::findOrFail($id);

        $this->authorizeAccess($order);

        if (! $order->cancel()) {
            return redirect()->route('order.show', ['id' => $id])
                ->with('error', 'Este pedido ya no se puede cancelar.');
        }

        return redirect()->route('order.show', ['id' => $id])
            ->with('success', 'Pedido cancelado. El pago fue reembolsado.');
    }

    /**
     * Only the owner of the order can see it. Admins manage orders from the admin panel.
     */
    private function authorizeAccess(Order $order): void
    {
        abort_unless($order->user_id === Auth::id(), 403);
    }
}
