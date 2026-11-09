
@extends('admin.layout')

@section('title', $viewData['title'])

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>{{ $viewData['product']->getTitle() }}</h2>

        <div class="d-flex gap-2">
            <a href="{{ route('admin.product.edit', ['id' => $viewData['product']->getId()]) }}"
                class="btn btn-warning">
                {{ __('admin/product/show.editar_producto') }}
            </a>

            <a href="{{ route('admin.product.index') }}" class="btn btn-secondary">
                {{ __('common.volver') }}
            </a>
        </div>
    </div>

    @if ($viewData['product']->getImageUrl())
        <div class="text-center mb-4">
            <img
                src="{{ $viewData['product']->getImageUrl() }}"
                alt="{{ $viewData['product']->getTitle() }}"
                class="img-fluid rounded"
                style="max-height: 350px;"
            >
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">

            <h5>{{ __('common.descripcion') }}</h5>
            <p class="text-muted">
                {{ $viewData['product']->getDescription() }}
            </p>

            <hr>

            <div class="row">
                <div class="col-md-6">
                    <p>
                        <strong>{{ __('admin/product/show.precio') }}</strong>
                        {{ __('common.money', ['amount' => number_format($viewData['product']->getPrice(), 0, ',', '.')]) }}
                    </p>

                    <p>
                        <strong>{{ __('admin/product/show.stock') }}</strong>
                        {{ $viewData['product']->getStock() }}
                    </p>

                    <p>
                        <strong>{{ __('admin/product/show.formato') }}</strong>
                        {{ $viewData['product']->getFormatLabel() }}
                    </p>
                </div>

                <div class="col-md-6">
                    <p>
                        <strong>{{ __('admin/product/show.tipo') }}</strong>
                        {{ $viewData['product']->getTypeLabel() }}
                    </p>

                    <p>
                        <strong>{{ __('admin/product/show.plataforma') }}</strong>
                        {{ $viewData['product']->getPlatform() }}
                    </p>

                    <p>
                        <strong>{{ __('admin/product/show.categoria') }}</strong>
                        {{ $viewData['product']->getCategory()->getName() }}
                    </p>
                </div>
            </div>

        </div>
    </div>

</div>

@endsection
