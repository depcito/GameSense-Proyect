@extends('layouts.app')

@section('title', $viewData['title'])

@section('subtitle', 'Pedido ' . $viewData['order']->getCode())

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h4 class="mb-3">Pedido {{ $viewData['order']->getCode() }}</h4>

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
                    <strong>Estado:</strong>
                    {{ $viewData['order']->getStatus() }}
                </p>

                <p>
                    <strong>Fecha:</strong>
                    {{ $viewData['order']->getDate()->format('d/m/Y') }}
                </p>

                <hr>

                <h5 class="mb-3">Productos</h5>

                @foreach ($viewData['order']->getItems() as $item)
                    <div class="d-flex justify-content-between align-items-center border-bottom border-secondary py-2">
                        <div>
                            <span class="fw-bold">
                                {{ $item->getProduct()?->getTitle() ?? 'Producto eliminado' }}
                            </span>

                            <div class="text-muted small">
                                {{ $item->getQuantity() }} x
                                ${{ number_format($item->getUnitPrice(), 0, ',', '.') }} COP
                            </div>
                        </div>

                        <span>
                            ${{ number_format($item->getSubtotal(), 0, ',', '.') }} COP
                        </span>
                    </div>
                @endforeach

                <h4 class="text-end mt-3">
                    Total: ${{ number_format($viewData['order']->getTotal(), 0, ',', '.') }} COP
                </h4>

                <hr>

                <h5 class="mb-3">Datos de envío</h5>

                <p class="mb-1">{{ $viewData['order']->getShippingName() }}</p>
                <p class="mb-1">{{ $viewData['order']->getShippingAddress() }}, {{ $viewData['order']->getShippingCity() }}</p>
                <p class="mb-0">Tel. {{ $viewData['order']->getShippingPhone() }}</p>

                @if ($viewData['order']->payments->isNotEmpty())
                    <hr>

                    <h5 class="mb-3">Pago</h5>

                    @foreach ($viewData['order']->payments as $payment)
                        <p class="mb-1">
                            {{ $payment->getMethod() }}
                            · ${{ number_format($payment->getAmount(), 0, ',', '.') }} COP
                            · {{ $payment->getStatus() }}
                            · {{ $payment->getDate()->format('d/m/Y') }}
                        </p>
                    @endforeach
                @endif

                <div class="d-flex flex-wrap gap-2 mt-4">
                    @if ($viewData['canCancel'])
                        <form
                            method="POST"
                            action="{{ route('order.cancel', ['id' => $viewData['order']->getId()]) }}"
                            onsubmit="return confirm('¿Estás seguro de cancelar este pedido? El pago será reembolsado.')"
                        >
                            @csrf

                            <button type="submit" class="btn btn-outline-danger">
                                Cancelar pedido
                            </button>
                        </form>
                    @endif

                    <a href="{{ route('order.index') }}" class="btn btn-outline-secondary">
                        Volver a los pedidos
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
