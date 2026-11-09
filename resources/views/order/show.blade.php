@extends('layouts.app')

@section('title', $viewData['title'])

@section('subtitle', __('common.order_code', ['code' => $viewData['order']->getCode()]))

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h4 class="mb-3">{{ __('common.order_code', ['code' => $viewData['order']->getCode()]) }}</h4>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <p>
                    <strong>{{ __('common.estado_label') }}</strong>
                    {{ $viewData['order']->getStatusLabel() }}
                </p>

                <p>
                    <strong>{{ __('common.fecha_label') }}</strong>
                    {{ $viewData['order']->getDate()->format('d/m/Y') }}
                </p>

                <hr>

                <h5 class="mb-3">{{ __('common.productos') }}</h5>

                @foreach ($viewData['order']->getItems() as $item)
                    <div class="d-flex justify-content-between align-items-center border-bottom border-secondary py-2">
                        <div>
                            <span class="fw-bold">
                                {{ $item->getProduct()?->getTitle() ?? __('common.product_deleted') }}
                            </span>

                            <div class="text-muted small">
                                {{ $item->getQuantity() }} x
                                {{ __('common.money', ['amount' => number_format($item->getUnitPrice(), 0, ',', '.')]) }}
                            </div>
                        </div>

                        <span>
                            {{ __('common.money', ['amount' => number_format($item->getSubtotal(), 0, ',', '.')]) }}
                        </span>
                    </div>
                @endforeach

                <h4 class="text-end mt-3">
                    {{ __('common.total_label') }} {{ __('common.money', ['amount' => number_format($viewData['order']->getTotal(), 0, ',', '.')]) }}
                </h4>

                <hr>

                <h5 class="mb-3">{{ __('common.datos_de_envio') }}</h5>

                <p class="mb-1">{{ $viewData['order']->getShippingName() }}</p>
                <p class="mb-1">{{ $viewData['order']->getShippingAddress() }}, {{ $viewData['order']->getShippingCity() }}</p>
                <p class="mb-0">{{ __('common.phone', ['phone' => $viewData['order']->getShippingPhone()]) }}</p>

                @if ($viewData['order']->payments->isNotEmpty())
                    <hr>

                    <h5 class="mb-3">{{ __('order/show.pago') }}</h5>

                    @foreach ($viewData['order']->payments as $payment)
                        <p class="mb-1">
                            {{ $payment->getMethodLabel() }}
                            · {{ __('common.money', ['amount' => number_format($payment->getAmount(), 0, ',', '.')]) }}
                            · {{ $payment->getStatusLabel() }}
                            · {{ $payment->getDate()->format('d/m/Y') }}
                        </p>
                    @endforeach
                @endif

                <div class="d-flex flex-wrap gap-2 mt-4">
                    @if ($viewData['canCancel'])
                        <form
                            method="POST"
                            action="{{ route('order.cancel', ['id' => $viewData['order']->getId()]) }}"
                            onsubmit="return confirm(@js(__('order/show.confirm_cancel')))"
                        >
                            @csrf

                            <button type="submit" class="btn btn-outline-danger">
                                {{ __('order/show.cancelar_pedido') }}
                            </button>
                        </form>
                    @endif

                    <a href="{{ route('order.index') }}" class="btn btn-outline-secondary">
                        {{ __('order/show.volver_a_los_pedidos') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
