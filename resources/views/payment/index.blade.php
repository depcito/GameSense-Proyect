@extends('layouts.app')

@section('title', $viewData['title'])

@section('subtitle', 'Historial de pagos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="mb-0">Pagos</h3>

    <a href="{{ route('payment.create') }}" class="btn btn-primary">
        Realizar pago
    </a>
</div>

<div class="row">
    @forelse ($viewData['payments'] as $payment)
        <div class="col-md-6 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title mb-1">
                            <a
                                href="{{ route('payment.show', ['id' => $payment->getId()]) }}"
                                class="text-decoration-none"
                            >
                                Pedido {{ $payment->getOrder()?->getCode() ?? 'eliminado' }}
                            </a>
                        </h5>
                        <span class="fw-bold">{{ $payment->getStatus() }}</span>
                    </div>

                    <p class="card-text mt-2">
                        ${{ number_format($payment->getAmount(), 0, ',', '.') }} COP
                        · {{ $payment->getMethod() }}
                    </p>

                    <p class="text-muted small mb-0">
                        Por {{ $payment->getUser()?->getName() ?? 'Usuario eliminado' }}
                        · {{ $payment->getDate()->format('d/m/Y') }}
                    </p>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center py-5">
            <h4>No hay pagos disponibles</h4>
            <p class="text-muted">
                Todavía no hay pagos para mostrar.
            </p>
        </div>
    @endforelse
</div>
@endsection
