@extends('layouts.app')

@section('title', $viewData['title'])

@section('subtitle', $viewData['item']->getProduct()?->getTitle() ?? __('common.product_deleted'))

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h4 class="mb-3">{{ __('item/show.detalles_del_item') }}</h4>

                <p>
                    <strong>{{ __('item/show.pedido') }}</strong>
                    #{{ $viewData['item']->getOrder()->getId() }}
                </p>

                <p>
                    <strong>{{ __('item/show.producto') }}</strong>
                    @if ($viewData['item']->getProduct())
                        <a
                            href="{{ route('product.show', ['id' => $viewData['item']->getProduct()->getId()]) }}"
                            class="text-decoration-none"
                        >
                            {{ $viewData['item']->getProduct()->getTitle() }}
                        </a>
                    @else
                        <span class="text-muted">{{ __('item/show.producto_eliminado') }}</span>
                    @endif
                </p>

                <p>
                    <strong>{{ __('item/show.cantidad') }}</strong>
                    {{ $viewData['item']->getQuantity() }}
                </p>

                <p>
                    <strong>{{ __('item/show.precio_unitario') }}</strong>
                    {{ __('common.money', ['amount' => number_format($viewData['item']->getUnitPrice(), 0, ',', '.')]) }}
                </p>

                <p>
                    <strong>{{ __('item/show.subtotal') }}</strong>
                    {{ __('common.money', ['amount' => number_format($viewData['item']->getSubtotal(), 0, ',', '.')]) }}
                </p>

                <div class="d-flex gap-2 mt-4">
                    <a
                        href="{{ route('item.index', ['order_id' => $viewData['item']->order_id]) }}"
                        class="btn btn-outline-secondary"
                    >
                        {{ __('item/show.volver_al_pedido') }}
                    </a>

                    <form method="POST" action="{{ route('item.delete', ['id' => $viewData['item']->getId()]) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger">{{ __('item/show.quitar_item') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection