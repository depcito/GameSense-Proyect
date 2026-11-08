@extends('admin.layout')

@section('title', $viewData['title'])

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Pedido {{ $viewData['order']->getCode() }}</h2>

        <a href="{{ route('admin.order.index') }}" class="btn btn-secondary">
            Volver
        </a>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <p>
                        <strong>Usuario:</strong>
                        {{ $viewData['order']->getUser()?->getName() ?? 'Usuario eliminado' }}
                    </p>
                    <p>
                        <strong>Fecha:</strong>
                        {{ $viewData['order']->getDate()->format('d/m/Y') }}
                    </p>
                </div>

                <div class="col-md-6">
                    <p>
                        <strong>Estado:</strong>
                        {{ $viewData['order']->getStatus() }}
                    </p>
                    <p>
                        <strong>Total:</strong>
                        ${{ number_format($viewData['order']->getTotal(), 0, ',', '.') }} COP
                    </p>
                </div>
            </div>

            <hr>

            <h5 class="mb-3">Productos</h5>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio unitario</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($viewData['order']->getItems() as $item)
                            <tr>
                                <td>{{ $item->getProduct()?->getTitle() ?? 'Producto eliminado' }}</td>
                                <td>{{ $item->getQuantity() }}</td>
                                <td>${{ number_format($item->getUnitPrice(), 0, ',', '.') }} COP</td>
                                <td>${{ number_format($item->getSubtotal(), 0, ',', '.') }} COP</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if ($viewData['order']->payments->isNotEmpty())
                <hr>

                <h5 class="mb-3">Pagos</h5>

                @foreach ($viewData['order']->payments as $payment)
                    <p class="mb-1">
                        <a href="{{ route('admin.payment.show', ['id' => $payment->getId()]) }}">
                            Pago #{{ $payment->getId() }}
                        </a>
                        · {{ $payment->getMethod() }}
                        · ${{ number_format($payment->getAmount(), 0, ',', '.') }} COP
                        · {{ $payment->getStatus() }}
                    </p>
                @endforeach
            @endif

            @if ($viewData['canCancel'])
                <hr>

                <form
                    method="POST"
                    action="{{ route('admin.order.cancel', ['id' => $viewData['order']->getId()]) }}"
                    onsubmit="return confirm('¿Estás seguro de cancelar este pedido?')">
                    @csrf

                    <button type="submit" class="btn btn-outline-danger">
                        Cancelar pedido
                    </button>
                </form>
            @endif

        </div>
    </div>

</div>

@endsection
