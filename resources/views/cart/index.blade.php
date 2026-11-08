@extends('layouts.app')

@section('title', $viewData['title'])

@section('subtitle', 'Revisa tu compra antes de confirmar')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="mb-0">Carrito</h3>

    <a href="{{ route('product.index') }}" class="btn btn-outline-secondary">
        Seguir comprando
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
        <h4>Tu carrito está vacío</h4>
        <p class="text-muted">
            Agrega productos para crear un pedido.
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
                                ${{ number_format($line['product']->getPrice(), 0, ',', '.') }} COP
                            </p>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <span class="fw-bold">
                                ${{ number_format($line['subtotal'], 0, ',', '.') }} COP
                            </span>

                            <form
                                method="POST"
                                action="{{ route('cart.remove', ['id' => $line['product']->getId()]) }}"
                            >
                                @csrf

                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    Quitar
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
                Total: ${{ number_format($viewData['total'], 0, ',', '.') }} COP
            </h4>

            <div class="d-flex gap-2">
                <form method="POST" action="{{ route('cart.clear') }}">
                    @csrf

                    <button type="submit" class="btn btn-outline-secondary">
                        Vaciar carrito
                    </button>
                </form>

                <form method="POST" action="{{ route('order.save') }}">
                    @csrf

                    <button type="submit" class="btn btn-primary">
                        Confirmar pedido
                    </button>
                </form>
            </div>
        </div>
    </div>
@endif
@endsection
