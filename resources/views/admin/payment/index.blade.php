@extends('admin.layout')

@section('title', 'Administrar pagos')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Administrar pagos</h2>
    </div>

    <form method="GET" action="{{ route('admin.payment.index') }}" class="row g-2 mb-3">
        <div class="col-sm-8 col-md-6">
            <input type="text" name="search" value="{{ $viewData['search'] }}" class="form-control"
                placeholder="Buscar por pedido, usuario, método o estado">
        </div>
        <div class="col-auto">
            <button class="btn btn-secondary" type="submit">Buscar</button>
            @if ($viewData['search'] !== '')
                <a href="{{ route('admin.payment.index') }}" class="btn btn-link">Limpiar</a>
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
                            <th>Pedido</th>
                            <th>Usuario</th>
                            <th>Monto</th>
                            <th>Método</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($viewData['payments'] as $payment)
                            <tr>
                                <td>{{ $payment->getId() }}</td>
                                <td>{{ $payment->getOrder()?->getCode() ?? 'Pedido eliminado' }}</td>
                                <td>{{ $payment->getUser()?->getName() ?? 'Usuario eliminado' }}</td>
                                <td>${{ number_format($payment->getAmount(), 0, ',', '.') }} COP</td>
                                <td>{{ $payment->getMethod() }}</td>
                                <td>{{ $payment->getStatus() }}</td>
                                <td>{{ $payment->getDate()->format('d/m/Y') }}</td>

                                <td>
                                    <a href="{{ route('admin.payment.show', ['id' => $payment->getId()]) }}"
                                        class="btn btn-info btn-sm">
                                        Ver
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    No hay pagos registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            {{ $viewData['payments']->links() }}

        </div>
    </div>

</div>

@endsection
