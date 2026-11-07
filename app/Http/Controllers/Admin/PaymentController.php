<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));

        $payments = Payment::with(['order', 'user'])
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('status', 'like', "%{$search}%")
                        ->orWhere('method', 'like', "%{$search}%")
                        ->orWhereHas('order', function ($order) use ($search) {
                            $order->where('code', 'like', "%{$search}%");
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
            'title' => 'Manage Payments',
            'payments' => $payments,
            'search' => $search,
        ];

        return view('admin.payment.index', ['viewData' => $viewData]);
    }

    public function show(int $id): View
    {
        $viewData = [
            'title' => 'Payment Details',
            'payment' => Payment::with(['order', 'user'])->findOrFail($id),
        ];

        return view('admin.payment.show', ['viewData' => $viewData]);
    }

    /**
     * Confirm or reject a pending payment. A confirmed payment marks its order as paid.
     */
    public function updateStatus(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'string', Rule::in([Payment::STATUS_COMPLETED, Payment::STATUS_FAILED])],
        ]);

        $updated = DB::transaction(function () use ($id, $validated) {
            $payment = Payment::lockForUpdate()->findOrFail($id);

            if ($payment->getStatus() !== Payment::STATUS_PENDING) {
                return false;
            }

            $payment->setStatus($validated['status']);
            $payment->save();

            if ($validated['status'] === Payment::STATUS_COMPLETED) {
                $order = $payment->order;
                $order->setStatus('Pagado');
                $order->save();
            }

            return true;
        });

        if (! $updated) {
            return redirect()->route('admin.payment.show', ['id' => $id])
                ->with('error', 'Solo se puede cambiar el estado de un pago pendiente.');
        }

        return redirect()->route('admin.payment.show', ['id' => $id])
            ->with('success', 'Estado del pago actualizado correctamente.');
    }
}
