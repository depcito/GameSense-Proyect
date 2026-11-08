@extends('layouts.app')

@section('title', $viewData['title'])

@section('subtitle', $viewData['item']->getProduct()?->getTitle() ?? 'Producto eliminado')

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h4 class="mb-3">Detalles del item</h4>

                <p>
                    <strong>Pedido:</strong>
                    #{{ $viewData['item']->getOrder()->getId() }}
                </p>

                <p>
                    <strong>Producto:</strong>
                    @if ($viewData['item']->getProduct())
                        <a
                            href="{{ route('product.show', ['id' => $viewData['item']->getProduct()->getId()]) }}"
                            class="text-decoration-none"
                        >
                            {{ $viewData['item']->getProduct()->getTitle() }}
                        </a>
                    @else
                        <span class="text-muted">Producto eliminado</span>
                    @endif
                </p>

                <p>
                    <strong>Cantidad:</strong>
                    {{ $viewData['item']->getQuantity() }}
                </p>

                <p>
                    <strong>Precio unitario:</strong>
                    ${{ number_format($viewData['item']->getUnitPrice(), 0, ',', '.') }} COP
                </p>

                <p>
                    <strong>Subtotal:</strong>
                    ${{ number_format($viewData['item']->getSubtotal(), 0, ',', '.') }} COP
                </p>

                <div class="d-flex gap-2 mt-4">
                    <a
                        href="{{ route('item.index', ['order_id' => $viewData['item']->order_id]) }}"
                        class="btn btn-outline-secondary"
                    >
                        Volver al pedido
                    </a>

                    <form method="POST" action="{{ route('item.delete', ['id' => $viewData['item']->getId()]) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger">Quitar item</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection