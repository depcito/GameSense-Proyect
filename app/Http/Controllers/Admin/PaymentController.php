<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
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
}
