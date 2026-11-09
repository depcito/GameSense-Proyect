@extends('layouts.app')

@section('title', $viewData['title'])

@section('subtitle', __('cart/index.revisa_tu_compra_antes'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="mb-0">{{ __('cart/index.carrito') }}</h3>

    <a href="{{ route('product.index') }}" class="btn btn-outline-secondary">
        {{ __('cart/index.seguir_comprando') }}
    </a>
</div>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (count($viewData['lines']) === 0)
    <div class="text-center py-5">
        <h4>{{ __('cart/index.tu_carrito_esta_vacio') }}</h4>
        <p class="text-muted">
            {{ __('cart/index.agrega_productos_para_crear') }}
        </p>
    </div>
@else
    <div class="row">
        @foreach ($viewData['lines'] as $line)
            <div class="col-12 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body d-flex flex-wrap justify-content-between align-items-center gap-3">
                        <div>
                            <h5 class="mb-1">
                                <a
                                    href="{{ route('product.show', ['id' => $line['product']->getId()]) }}"
                                    class="text-decoration-none"
                                >
                                    {{ $line['product']->getTitle() }}
                                </a>
                            </h5>

                            <p class="text-muted small mb-0">
                                {{ $line['quantity'] }} x
                                {{ __('common.money', ['amount' => number_format($line['product']->getPrice(), 0, ',', '.')]) }}
                            </p>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <span class="fw-bold">
                                {{ __('common.money', ['amount' => number_format($line['subtotal'], 0, ',', '.')]) }}
                            </span>

                            <form
                                method="POST"
                                action="{{ route('cart.remove', ['id' => $line['product']->getId()]) }}"
                            >
                                @csrf

                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    {{ __('cart/index.quitar') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="card border-0 shadow-sm mt-2">
        <div class="card-body d-flex flex-wrap justify-content-between align-items-center gap-3">
            <h4 class="mb-0">
                {{ __('common.total_label') }} {{ __('common.money', ['amount' => number_format($viewData['total'], 0, ',', '.')]) }}
            </h4>

            <div class="d-flex gap-2">
                <form method="POST" action="{{ route('cart.clear') }}">
                    @csrf

                    <button type="submit" class="btn btn-outline-secondary">
                        {{ __('cart/index.vaciar_carrito') }}
                    </button>
                </form>

                <a href="{{ route('checkout.index') }}" class="btn btn-primary">
                    {{ __('cart/index.proceder_al_pago') }}
                </a>
            </div>
        </div>
    </div>
@endif
@endsection
