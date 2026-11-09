@extends('admin.layout')

@section('title', __('admin/payment/index.administrar_pagos'))

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>{{ __('admin/payment/index.administrar_pagos') }}</h2>
    </div>

    <form method="GET" action="{{ route('admin.payment.index') }}" class="row g-2 mb-3">
        <div class="col-sm-8 col-md-6">
            <input type="text" name="search" value="{{ $viewData['search'] }}" class="form-control"
                placeholder="{{ __('admin/payment/index.buscar_por_pedido_usuario') }}">
        </div>
        <div class="col-auto">
            <button class="btn btn-secondary" type="submit">{{ __('common.buscar') }}</button>
            @if ($viewData['search'] !== '')
                <a href="{{ route('admin.payment.index') }}" class="btn btn-link">{{ __('common.limpiar') }}</a>
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
                            <th>{{ __('admin/payment/index.pedido') }}</th>
                            <th>{{ __('common.usuario') }}</th>
                            <th>{{ __('admin/payment/index.monto') }}</th>
                            <th>{{ __('admin/payment/index.metodo') }}</th>
                            <th>{{ __('admin/payment/index.estado') }}</th>
                            <th>{{ __('common.fecha') }}</th>
                            <th>{{ __('common.acciones') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($viewData['payments'] as $payment)
                            <tr>
                                <td>{{ $payment->getId() }}</td>
                                <td>{{ $payment->getOrder()?->getCode() ?? __('common.order_deleted') }}</td>
                                <td>{{ $payment->getUser()?->getName() ?? __('common.user_deleted') }}</td>
                                <td>{{ __('common.money', ['amount' => number_format($payment->getAmount(), 0, ',', '.')]) }}</td>
                                <td>{{ $payment->getMethod() }}</td>
                                <td>{{ $payment->getStatus() }}</td>
                                <td>{{ $payment->getDate()->format('d/m/Y') }}</td>

                                <td>
                                    <a href="{{ route('admin.payment.show', ['id' => $payment->getId()]) }}"
                                        class="btn btn-info btn-sm">
                                        {{ __('common.ver') }}
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    {{ __('admin/payment/index.no_hay_pagos_registrados') }}
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
