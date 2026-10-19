@extends('layouts.app')

@section('title', $viewData['title'])

@section('subtitle', 'Pedido ' . ($viewData['payment']->getOrder()?->getCode() ?? 'eliminado'))

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h4 class="mb-3">Detalles del pago</h4>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <p>
                    <strong>Pedido:</strong>
                    {{ $viewData['payment']->getOrder()?->getCode() ?? 'Pedido eliminado' }}
                </p>

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

                <p>
                    <strong>Fecha:</strong>
                    {{ $viewData['payment']->getDate()->format('d/m/Y') }}
                </p>

                <p>
                    <strong>Usuario:</strong>
                    {{ $viewData['payment']->getUser()?->getName() ?? 'Usuario eliminado' }}
                </p>

                @if (auth()->user()->role === 'admin' && $viewData['payment']->getStatus() === 'Pendiente')
                    <hr>

                    <form
                        method="POST"
                        action="{{ route('payment.updateStatus', ['id' => $viewData['payment']->getId()]) }}"
                        class="d-flex gap-2"
                    >
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

                <a href="{{ route('payment.index') }}" class="btn btn-outline-secondary mt-3">
                    Volver a los pagos
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
