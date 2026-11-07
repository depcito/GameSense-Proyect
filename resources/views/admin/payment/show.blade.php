@extends('admin.layout')

@section('title', $viewData['title'])

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Pago #{{ $viewData['payment']->getId() }}</h2>

        <a href="{{ route('admin.payment.index') }}" class="btn btn-secondary">
            Volver
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <p>
                        <strong>Pedido:</strong>
                        {{ $viewData['payment']->getOrder()?->getCode() ?? 'Pedido eliminado' }}
                    </p>
                    <p>
                        <strong>Usuario:</strong>
                        {{ $viewData['payment']->getUser()?->getName() ?? 'Usuario eliminado' }}
                    </p>
                    <p>
                        <strong>Fecha:</strong>
                        {{ $viewData['payment']->getDate()->format('d/m/Y') }}
                    </p>
                </div>

                <div class="col-md-6">
                    <p>
                        <strong>Monto:</strong>
                        ${{ number_format($viewData['payment']->getAmount(), 0, ',', '.') }} COP
                    </p>
                    <p>
                        <strong>Método:</strong>
                        {{ $viewData['payment']->getMethod() }}
                    </p>
                    <p>
                        <strong>Estado:</strong>
                        {{ $viewData['payment']->getStatus() }}
                    </p>
                </div>
            </div>

            @if ($viewData['payment']->getStatus() === 'Pendiente')
                <hr>

                <form
                    method="POST"
                    action="{{ route('admin.payment.updateStatus', ['id' => $viewData['payment']->getId()]) }}"
                    class="d-flex gap-2">
                    @csrf
                    @method('PATCH')

                    <button type="submit" name="status" value="Completado" class="btn btn-primary">
                        Confirmar pago
                    </button>

                    <button type="submit" name="status" value="Fallido" class="btn btn-outline-danger">
                        Rechazar pago
                    </button>
                </form>
            @endif

        </div>
    </div>

</div>

@endsection
