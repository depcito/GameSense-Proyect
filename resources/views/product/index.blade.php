
@extends('layouts.app')

@section('title', $viewData['title'])

@section('subtitle', __('product/index.explora_nuestros_productos'))

@section('content')

<div class="row">
    @forelse ($viewData['products'] as $product)
        <div class="col-md-4 col-lg-3 mb-4">

            <a
                href="{{ route('product.show', ['id' => $product->getId()]) }}"
                class="text-decoration-none text-reset"
            >
                <div class="card category-card h-100 border-0 shadow-sm">

                    @if ($product->getImageUrl())
                        <img src="{{ $product->getImageUrl() ?? asset('images/placeholder.png') }}"
                            alt="{{ $product->getTitle() }}"
                            class="card-img-top"
                            style="height: 300px; object-fit: cover;"
                        >
                    @endif

                    <div class="category-cover d-flex align-items-center justify-content-center px-2"
                        style="height: 60px; min-height: 0;">
                        <h3 class="category-name text-center">
                            {{ $product->getTitle() }}
                        </h3>
                    </div>

                    <div class="card-body text-center">

                        <p class="card-text text-muted">
                            {{ $product->getDescription() }}
                        </p>

                        <p class="fw-bold mb-1">
                            {{ __('common.price_label') }} {{ __('common.money', ['amount' => number_format($product->getPrice(), 0, ',', '.')]) }}
                        </p>

                        <p class="text-muted small mb-0">
                            {{ __('common.available_units_label') }} {{ $product->getStock() }}
                        </p>

                        <span class="btn btn-primary mt-3">
                            {{ __('product/index.ver_producto') }}
                        </span>

                    </div>
                </div>
            </a>

        </div>
    @empty
        <div class="col-12 text-center py-5">
            <h4>{{ __('product/index.no_hay_productos_disponibles') }}</h4>
            <p class="text-muted">
                {{ __('product/index.todavia_no_hay_productos') }}
            </p>
        </div>
    @endforelse
</div>

@endsection
