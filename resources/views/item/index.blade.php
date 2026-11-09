@extends('layouts.app')

@section('title', $viewData['title'])

@section('subtitle', __('common.order_number', ['id' => $viewData['order']->getId()]))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="mb-0">{{ __('item/index.heading', ['id' => $viewData['order']->getId()]) }}</h3>

    <a
        href="{{ route('item.create', ['order_id' => $viewData['order']->getId()]) }}"
        class="btn btn-primary"
    >
        {{ __('item/index.agregar_item') }}
    </a>
</div>

@if ($viewData['items']->isEmpty())
    <div class="text-center py-5">
        <h4>{{ __('item/index.este_pedido_no_tiene') }}</h4>
        <p class="text-muted">{{ __('item/index.agrega_productos_para_comenzar') }}</p>
    </div>
@else
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>{{ __('common.producto') }}</th>
                        <th class="text-end">{{ __('common.cantidad') }}</th>
                        <th class="text-end">{{ __('item/index.precio_unitario') }}</th>
                        <th class="text-end">{{ __('item/index.subtotal') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($viewData['items'] as $item)
                        <tr>
                            <td>
                                <a
                                    href="{{ route('item.show', ['id' => $item->getId()]) }}"
                                    class="text-decoration-none"
                                >
                                    {{ $item->getProduct()?->getTitle() ?? __('common.product_deleted') }}
                                </a>
                            </td>
                            <td class="text-end">{{ $item->getQuantity() }}</td>
                            <td class="text-end">{{ __('common.money', ['amount' => number_format($item->getUnitPrice(), 0, ',', '.')]) }}</td>
                            <td class="text-end">{{ __('common.money', ['amount' => number_format($item->getSubtotal(), 0, ',', '.')]) }}</td>
                            <td class="text-end">
                                <form method="POST" action="{{ route('item.delete', ['id' => $item->getId()]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">{{ __('item/index.quitar') }}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-end">{{ __('item/index.total') }}</th>
                        <th class="text-end">
                            ${{ number_format($viewData['items']->sum(fn ($item) => $item->getSubtotal()), 0, ',', '.') }} COP
                        </th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endif
@endsection