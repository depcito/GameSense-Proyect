<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PaymentController extends Controller
{
    /**
     * List the payments made by the authenticated user.
     */
    public function index(): View
    {
        $viewData = [
            'title' => 'Pagos',
            'payments' => Payment::with(['order', 'user'])
                ->where('user_id', Auth::id())
                ->latest('date')
                ->latest('id')
                ->get(),
        ];

        return view('payment.index', ['viewData' => $viewData]);
    }

    /**
     * Show the payment form with the user's orders that are still waiting for a payment.
     */
    public function create(Request $request): View
    {
        $orders = Order::where('user_id', Auth::id())
            ->where('status', 'Pendiente')
            ->whereDoesntHave('payments', function ($query) {
                $query->whereIn('status', [Payment::STATUS_PENDING, Payment::STATUS_COMPLETED]);
            })
            ->orderBy('id')
            ->get();

        $viewData = [
            'title' => 'Realizar pago',
            'orders' => $orders,
            'methods' => Payment::METHODS,
            'selectedOrderId' => $request->input('order_id'),
        ];

        return view('payment.create', ['viewData' => $viewData]);
    }

    /**
     * Register a payment. The amount is taken from the order, never from the request.
     */
    public function save(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'order_id' => ['required', 'integer', 'exists:orders,id'],
            'method' => ['required', 'string', Rule::in(Payment::METHODS)],
        ]);

        $payment = DB::transaction(function () use ($validated) {
            $order = Order::lockForUpdate()->findOrFail($validated['order_id']);

            abort_unless($order->user_id === Auth::id(), 403);

            if ($order->getStatus() !== 'Pendiente') {
                return null;
            }

            $hasActivePayment = $order->payments()
                ->whereIn('status', [Payment::STATUS_PENDING, Payment::STATUS_COMPLETED])
                ->exists();

            if ($hasActivePayment) {
                return null;
            }

            $payment = new Payment;

            $payment->setMethod($validated['method']);
            $payment->setAmount($order->getTotal());
            $payment->setDate(now()->toDateString());
            $payment->setStatus(Payment::STATUS_PENDING);

            $payment->order_id = $order->getId();
            $payment->user_id = Auth::id();

            $payment->save();

            return $payment;
        });

        if ($payment === null) {
            return back()
                ->withInput()
                ->withErrors(['order_id' => 'Este pedido ya fue pagado o ya tiene un pago en proceso.']);
        }

        return redirect()
            ->route('payment.show', ['id' => $payment->getId()])
            ->with('success', 'Pago registrado correctamente. Está pendiente de confirmación.');
    }

    public function show(int $id): View
    {
        $payment = Payment::with(['order', 'user'])->findOrFail($id);

        $this->authorizeAccess($payment);

        $viewData = [
            'title' => 'Detalle del pago',
            'payment' => $payment,
        ];

        return view('payment.show', ['viewData' => $viewData]);
    }

    /**
     * Only the owner of the payment can see it. Admins manage payments from the admin panel.
     */
    private function authorizeAccess(Payment $payment): void
    {
        abort_unless($payment->user_id === Auth::id(), 403);
    }
}
