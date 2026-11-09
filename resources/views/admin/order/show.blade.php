@extends('admin.layout')

@section('title', $viewData['title'])

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>{{ __('common.order_code', ['code' => $viewData['order']->getCode()]) }}</h2>

        <a href="{{ route('admin.order.index') }}" class="btn btn-secondary">
            {{ __('common.volver') }}
        </a>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <p>
                        <strong>{{ __('common.usuario_label') }}</strong>
                        {{ $viewData['order']->getUser()?->getName() ?? __('common.user_deleted') }}
                    </p>
                    <p>
                        <strong>{{ __('common.fecha_label') }}</strong>
                        {{ $viewData['order']->getDate()->format('d/m/Y') }}
                    </p>
                </div>

                <div class="col-md-6">
                    <p>
                        <strong>{{ __('common.estado_label') }}</strong>
                        {{ $viewData['order']->getStatus() }}
                    </p>
                    <p>
                        <strong>{{ __('admin/order/show.total') }}</strong>
                        {{ __('common.money', ['amount' => number_format($viewData['order']->getTotal(), 0, ',', '.')]) }}
                    </p>
                </div>
            </div>

            <hr>

            <h5 class="mb-3">{{ __('common.productos') }}</h5>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>{{ __('common.producto') }}</th>
                            <th>{{ __('common.cantidad') }}</th>
                            <th>{{ __('admin/order/show.precio_unitario') }}</th>
                            <th>{{ __('admin/order/show.subtotal') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($viewData['order']->getItems() as $item)
                            <tr>
                                <td>{{ $item->getProduct()?->getTitle() ?? __('common.product_deleted') }}</td>
                                <td>{{ $item->getQuantity() }}</td>
                                <td>{{ __('common.money', ['amount' => number_format($item->getUnitPrice(), 0, ',', '.')]) }}</td>
                                <td>{{ __('common.money', ['amount' => number_format($item->getSubtotal(), 0, ',', '.')]) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <hr>

            <h5 class="mb-3">{{ __('common.datos_de_envio') }}</h5>

            <p class="mb-1">{{ $viewData['order']->getShippingName() }}</p>
            <p class="mb-1">{{ $viewData['order']->getShippingAddress() }}, {{ $viewData['order']->getShippingCity() }}</p>
            <p class="mb-0">{{ __('common.phone', ['phone' => $viewData['order']->getShippingPhone()]) }}</p>

            @if ($viewData['order']->payments->isNotEmpty())
                <hr>

                <h5 class="mb-3">{{ __('admin/order/show.pagos') }}</h5>

                @foreach ($viewData['order']->payments as $payment)
                    <p class="mb-1">
                        <a href="{{ route('admin.payment.show', ['id' => $payment->getId()]) }}">
                            {{ __('common.payment_number', ['id' => $payment->getId()]) }}
                        </a>
                        · {{ $payment->getMethod() }}
                        · {{ __('common.money', ['amount' => number_format($payment->getAmount(), 0, ',', '.')]) }}
                        · {{ $payment->getStatus() }}
                    </p>
                @endforeach
            @endif

            @if ($viewData['canCancel'])
                <hr>

                <form
                    method="POST"
                    action="{{ route('admin.order.cancel', ['id' => $viewData['order']->getId()]) }}"
                    onsubmit="return confirm(@js(__('admin/order/show.confirm_cancel')))">
                    @csrf

                    <button type="submit" class="btn btn-outline-danger">
                        {{ __('admin/order/show.cancelar_pedido') }}
                    </button>
                </form>
            @endif

        </div>
    </div>

</div>

@endsection
