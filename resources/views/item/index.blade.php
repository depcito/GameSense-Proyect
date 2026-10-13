@extends('layouts.app')

@section('title', $viewData['title'])

@section('subtitle', 'Pedido #' . $viewData['order']->getId())

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="mb-0">Items del pedido #{{ $viewData['order']->getId() }}</h3>

    <a
        href="{{ route('item.create', ['order_id' => $viewData['order']->getId()]) }}"
        class="btn btn-primary"
    >
        Agregar item
    </a>
</div>

@if ($viewData['items']->isEmpty())
    <div class="text-center py-5">
        <h4>Este pedido no tiene items</h4>
        <p class="text-muted">Agrega productos para comenzar.</p>
    </div>
@else
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th class="text-end">Cantidad</th>
                        <th class="text-end">Precio unitario</th>
                        <th class="text-end">Subtotal</th>
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
                                    {{ $item->getProduct()?->getTitle() ?? 'Producto eliminado' }}
                                </a>
                            </td>
                            <td class="text-end">{{ $item->getQuantity() }}</td>
                            <td class="text-end">${{ number_format($item->getUnitPrice(), 0, ',', '.') }} COP</td>
                            <td class="text-end">${{ number_format($item->getSubtotal(), 0, ',', '.') }} COP</td>
                            <td class="text-end">
                                <form method="POST" action="{{ route('item.delete', ['id' => $item->getId()]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Quitar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-end">Total</th>
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