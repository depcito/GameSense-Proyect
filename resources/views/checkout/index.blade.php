@extends('layouts.app')

@section('title', $viewData['title'])

@section('subtitle', 'Completa tus datos y paga')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="mb-0">Finalizar compra</h3>

    <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary">
        Volver al carrito
    </a>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('checkout.save') }}">
    @csrf

    <div class="row">
        <div class="col-lg-7 mb-4">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h4 class="mb-4">Datos de envío</h4>

                    <div class="mb-3">
                        <label for="shipping_name" class="form-label">Nombre completo</label>
                        <input
                            type="text"
                            name="shipping_name"
                            id="shipping_name"
                            class="form-control"
                            value="{{ old('shipping_name', $viewData['user']->getName()) }}"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label for="shipping_phone" class="form-label">Teléfono</label>
                        <input
                            type="text"
                            name="shipping_phone"
                            id="shipping_phone"
                            class="form-control"
                            value="{{ old('shipping_phone') }}"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label for="shipping_address" class="form-label">Dirección</label>
                        <input
                            type="text"
                            name="shipping_address"
                            id="shipping_address"
                            class="form-control"
                            value="{{ old('shipping_address', $viewData['user']->getAddress()) }}"
                            required
                        >
                    </div>

                    <div class="mb-0">
                        <label for="shipping_city" class="form-label">Ciudad</label>
                        <input
                            type="text"
                            name="shipping_city"
                            id="shipping_city"
                            class="form-control"
                            value="{{ old('shipping_city') }}"
                            required
                        >
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h4 class="mb-4">Método de pago</h4>

                    <div class="mb-3">
                        <label for="method" class="form-label">Método</label>
                        <select name="method" id="method" class="form-select" required>
                            <option value="">Selecciona un método</option>
                            @foreach ($viewData['methods'] as $method)
                                <option value="{{ $method }}" @selected(old('method') == $method)>
                                    {{ $method }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <p class="text-muted small mb-0">
                        El pago se realiza de inmediato por el total de la compra. No se almacenan datos de tarjetas.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-5 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h4 class="mb-4">Resumen del pedido</h4>

                    @foreach ($viewData['lines'] as $line)
                        <div class="d-flex justify-content-between align-items-center border-bottom border-secondary py-2">
                            <div>
                                <span class="fw-bold">{{ $line['product']->getTitle() }}</span>

                                <div class="text-muted small">
                                    {{ $line['quantity'] }} x
                                    ${{ number_format($line['product']->getPrice(), 0, ',', '.') }} COP
                                </div>
                            </div>

                            <span>
                                ${{ number_format($line['subtotal'], 0, ',', '.') }} COP
                            </span>
                        </div>
                    @endforeach

                    <h4 class="text-end mt-3">
                        Total: ${{ number_format($viewData['total'], 0, ',', '.') }} COP
                    </h4>

                    <button type="submit" class="btn btn-primary w-100 mt-3">
                        Pagar ahora
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
