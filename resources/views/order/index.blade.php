@extends('layouts.app')

@section('title', $viewData['title'])

@section('subtitle', __('order/index.historial_de_pedidos'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="mb-0">{{ __('order/index.pedidos') }}</h3>

    <a href="{{ route('product.index') }}" class="btn btn-primary">
        {{ __('order/index.seguir_comprando') }}
    </a>
</div>

<div class="row">
    @forelse ($viewData['orders'] as $order)
        <div class="col-md-6 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title mb-1">
                            <a
                                href="{{ route('order.show', ['id' => $order->getId()]) }}"
                                class="text-decoration-none"
                            >
                                {{ __('common.order_code', ['code' => $order->getCode()]) }}
                            </a>
                        </h5>
                        <span class="fw-bold">{{ $order->getStatus() }}</span>
                    </div>

                    <p class="card-text mt-2">
                        {{ __('common.money', ['amount' => number_format($order->getTotal(), 0, ',', '.')]) }}
                        · {{ $order->items_count }} {{ $order->items_count === 1 ? 'producto' : 'productos' }}
                    </p>

                    <p class="text-muted small mb-0">
                        {{ $order->getDate()->format('d/m/Y') }}
                    </p>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center py-5">
            <h4>{{ __('order/index.no_tienes_pedidos') }}</h4>
            <p class="text-muted">
                {{ __('order/index.todavia_no_has_realizado') }}
            </p>
        </div>
    @endforelse
</div>
@endsection
