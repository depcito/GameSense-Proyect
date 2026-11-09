@extends('admin.layout')

@section('title', $viewData['title'])

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>{{ __('common.payment_number', ['id' => $viewData['payment']->getId()]) }}</h2>

        <a href="{{ route('admin.payment.index') }}" class="btn btn-secondary">
            {{ __('common.volver') }}
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <p>
                        <strong>{{ __('admin/payment/show.pedido') }}</strong>
                        {{ $viewData['payment']->getOrder()?->getCode() ?? __('common.order_deleted') }}
                    </p>
                    <p>
                        <strong>{{ __('common.usuario_label') }}</strong>
                        {{ $viewData['payment']->getUser()?->getName() ?? __('common.user_deleted') }}
                    </p>
                    <p>
                        <strong>{{ __('common.fecha_label') }}</strong>
                        {{ $viewData['payment']->getDate()->format('d/m/Y') }}
                    </p>
                </div>

                <div class="col-md-6">
                    <p>
                        <strong>{{ __('admin/payment/show.monto') }}</strong>
                        {{ __('common.money', ['amount' => number_format($viewData['payment']->getAmount(), 0, ',', '.')]) }}
                    </p>
                    <p>
                        <strong>{{ __('admin/payment/show.metodo') }}</strong>
                        {{ $viewData['payment']->getMethod() }}
                    </p>
                    <p>
                        <strong>{{ __('common.estado_label') }}</strong>
                        {{ $viewData['payment']->getStatus() }}
                    </p>
                </div>
            </div>

        </div>
    </div>

</div>

@endsection
