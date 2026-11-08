@extends('admin.layout')

@section('title', 'Administrar pedidos')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Administrar pedidos</h2>
    </div>

    <form method="GET" action="{{ route('admin.order.index') }}" class="row g-2 mb-3">
        <div class="col-sm-8 col-md-6">
            <input type="text" name="search" value="{{ $viewData['search'] }}" class="form-control"
                placeholder="Buscar por código, usuario o estado">
        </div>
        <div class="col-auto">
            <button class="btn btn-secondary" type="submit">Buscar</button>
            @if ($viewData['search'] !== '')
                <a href="{{ route('admin.order.index') }}" class="btn btn-link">Limpiar</a>
            @endif
        </div>
    </form>

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Código</th>
                            <th>Usuario</th>
                            <th>Productos</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($viewData['orders'] as $order)
                            <tr>
                                <td>{{ $order->getId() }}</td>
                                <td>{{ $order->getCode() }}</td>
                                <td>{{ $order->getUser()?->getName() ?? 'Usuario eliminado' }}</td>
                                <td>{{ $order->items_count }}</td>
                                <td>${{ number_format($order->getTotal(), 0, ',', '.') }} COP</td>
                                <td>{{ $order->getStatus() }}</td>
                                <td>{{ $order->getDate()->format('d/m/Y') }}</td>

                                <td>
                                    <a href="{{ route('admin.order.show', ['id' => $order->getId()]) }}"
                                        class="btn btn-info btn-sm">
                                        Ver
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    No hay pedidos registrados.
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
