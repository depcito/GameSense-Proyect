
@extends('admin.layout')

@section('title', $viewData['title'])

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>{{ $viewData['category']->getName() }}</h2>

        <div class="d-flex gap-2">
            <a href="{{ route('admin.category.edit', ['id' => $viewData['category']->getId()]) }}"
                class="btn btn-warning">
                {{ __('admin/category/show.editar_categoria') }}
            </a>

            <a href="{{ route('admin.category.index') }}" class="btn btn-secondary">
                {{ __('common.volver') }}
            </a>
        </div>
    </div>

    @if ($viewData['category']->getImageUrl())
        <div class="text-center mb-4">
            <img
                src="{{ $viewData['category']->getImageUrl() }}"
                alt="{{ $viewData['category']->getName() }}"
                class="img-fluid rounded"
                style="max-height: 300px;"
            >
        </div>
    @endif

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5>{{ __('common.descripcion') }}</h5>
            <p class="text-muted mb-0">
                {{ $viewData['category']->getDescription() }}
            </p>
        </div>
    </div>

    <h4 class="mb-3">{{ __('admin/category/show.productos_de_esta_categoria') }}</h4>

    <div class="row">
        @forelse ($viewData['category']->getProducts() as $product)
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card h-100 border-0 shadow-sm">

                    @if ($product->getImageUrl())
                        <img
                            src="{{ $product->getImageUrl() }}"
                            alt="{{ $product->getTitle() }}"
                            class="card-img-top"
                            style="height: 180px; object-fit: cover;"
                        >
                    @endif

                    <div class="card-body text-center">
                        <h5 class="card-title">
                            {{ $product->getTitle() }}
                        </h5>

                        <p class="card-text text-muted">
                            {{ $product->getDescription() }}
                        </p>

                        <p class="fw-bold mb-0">
                            {{ __('common.price_label') }} {{ __('common.money', ['amount' => number_format($product->getPrice(), 0, ',', '.')]) }}
                        </p>

                        <p class="text-muted small mb-0">
                            {{ __('common.stock_label') }} {{ $product->getStock() }}
                        </p>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-muted">
                    {{ __('admin/category/show.todavia_no_hay_productos') }}
                </p>
            </div>
        @endforelse
    </div>

</div>

@endsection
