@extends('layouts.app')

@section('title', $viewData['title'])

@section('subtitle', __('checkout/index.completa_tus_datos_y'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="mb-0">{{ __('checkout/index.finalizar_compra') }}</h3>

    <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary">
        {{ __('checkout/index.volver_al_carrito') }}
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
                    <h4 class="mb-4">{{ __('common.datos_de_envio') }}</h4>

                    <div class="mb-3">
                        <label for="shipping_name" class="form-label">{{ __('checkout/index.nombre_completo') }}</label>
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
                        <label for="shipping_phone" class="form-label">{{ __('checkout/index.telefono') }}</label>
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
                        <label for="shipping_address" class="form-label">{{ __('common.direccion') }}</label>
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
                        <label for="shipping_city" class="form-label">{{ __('checkout/index.ciudad') }}</label>
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
                    <h4 class="mb-4">{{ __('checkout/index.metodo_de_pago') }}</h4>

                    <div class="mb-3">
                        <label for="method" class="form-label">{{ __('checkout/index.metodo') }}</label>
                        <select name="method" id="method" class="form-select" required>
                            <option value="">{{ __('checkout/index.selecciona_un_metodo') }}</option>
                            @foreach ($viewData['methods'] as $method)
                                <option value="{{ $method }}" @selected(old('method') == $method)>
                                    {{ App\Utils\EnumLabel::for('models/Payment.method', $method) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <p class="text-muted small mb-0">
                        {{ __('checkout/index.el_pago_se_realiza') }}
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-5 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h4 class="mb-4">{{ __('checkout/index.resumen_del_pedido') }}</h4>

                    @foreach ($viewData['lines'] as $line)
                        <div class="d-flex justify-content-between align-items-center border-bottom border-secondary py-2">
                            <div>
                                <span class="fw-bold">{{ $line['product']->getTitle() }}</span>

                                <div class="text-muted small">
                                    {{ $line['quantity'] }} x
                                    {{ __('common.money', ['amount' => number_format($line['product']->getPrice(), 0, ',', '.')]) }}
                                </div>
                            </div>

                            <span>
                                {{ __('common.money', ['amount' => number_format($line['subtotal'], 0, ',', '.')]) }}
                            </span>
                        </div>
                    @endforeach

                    <h4 class="text-end mt-3">
                        {{ __('common.total_label') }} {{ __('common.money', ['amount' => number_format($viewData['total'], 0, ',', '.')]) }}
                    </h4>

                    <button type="submit" class="btn btn-primary w-100 mt-3">
                        {{ __('checkout/index.pagar_ahora') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
