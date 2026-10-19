@extends('layouts.app')

@section('title', $viewData['title'])

@section('subtitle', 'Paga tus pedidos pendientes')

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h4 class="mb-4">Nuevo pago</h4>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if ($viewData['orders']->isEmpty())
                    <p class="text-muted">
                        No tienes pedidos pendientes de pago.
                    </p>

                    <a href="{{ route('payment.index') }}" class="btn btn-secondary">
                        Volver a los pagos
                    </a>
                @else
                    <form method="POST" action="{{ route('payment.save') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="order_id" class="form-label">Pedido</label>
                            <select name="order_id" id="order_id" class="form-select" required>
                                <option value="">Selecciona un pedido</option>
                                @foreach ($viewData['orders'] as $order)
                                    <option
                                        value="{{ $order->getId() }}"
                                        @selected(old('order_id', $viewData['selectedOrderId']) == $order->getId())
                                    >
                                        {{ $order->getCode() }} - ${{ number_format($order->getTotal(), 0, ',', '.') }} COP
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="method" class="form-label">Método de pago</label>
                            <select name="method" id="method" class="form-select" required>
                                <option value="">Selecciona un método</option>
                                @foreach ($viewData['methods'] as $method)
                                    <option value="{{ $method }}" @selected(old('method') == $method)>
                                        {{ $method }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <p class="text-muted small">
                            El valor a pagar es el total del pedido. No se almacenan datos de tarjetas.
                        </p>

                        <button type="submit" class="btn btn-primary">
                            Registrar pago
                        </button>

                        <a href="{{ route('payment.index') }}" class="btn btn-secondary">
                            Cancelar
                        </a>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
