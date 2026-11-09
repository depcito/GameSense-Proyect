@extends('admin.layout')

@section('title', __('admin/order/index.administrar_pedidos'))

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>{{ __('admin/order/index.administrar_pedidos') }}</h2>
    </div>

    <form method="GET" action="{{ route('admin.order.index') }}" class="row g-2 mb-3">
        <div class="col-sm-8 col-md-6">
            <input type="text" name="search" value="{{ $viewData['search'] }}" class="form-control"
                placeholder="{{ __('admin/order/index.buscar_por_codigo_usuario') }}">
        </div>
        <div class="col-auto">
            <button class="btn btn-secondary" type="submit">{{ __('common.buscar') }}</button>
            @if ($viewData['search'] !== '')
                <a href="{{ route('admin.order.index') }}" class="btn btn-link">{{ __('common.limpiar') }}</a>
            @endif
        </div>
    </form>

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle">

                    <thead>
                        <tr>
                            <th>{{ __('common.id') }}</th>
                            <th>{{ __('admin/order/index.codigo') }}</th>
                            <th>{{ __('common.usuario') }}</th>
                            <th>{{ __('common.productos') }}</th>
                            <th>{{ __('admin/order/index.total') }}</th>
                            <th>{{ __('admin/order/index.estado') }}</th>
                            <th>{{ __('common.fecha') }}</th>
                            <th>{{ __('common.acciones') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($viewData['orders'] as $order)
                            <tr>
                                <td>{{ $order->getId() }}</td>
                                <td>{{ $order->getCode() }}</td>
                                <td>{{ $order->getUser()?->getName() ?? __('common.user_deleted') }}</td>
                                <td>{{ $order->items_count }}</td>
                                <td>{{ __('common.money', ['amount' => number_format($order->getTotal(), 0, ',', '.')]) }}</td>
                                <td>{{ $order->getStatusLabel() }}</td>
                                <td>{{ $order->getDate()->format('d/m/Y') }}</td>

                                <td>
                                    <a href="{{ route('admin.order.show', ['id' => $order->getId()]) }}"
                                        class="btn btn-info btn-sm">
                                        {{ __('common.ver') }}
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    {{ __('admin/order/index.no_hay_pedidos_registrados') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            {{ $viewData['orders']->links() }}

        </div>
    </div>

</div>

@endsection
