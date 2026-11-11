@extends('layouts.app')

@section('title', $viewData['title'])

@section('subtitle', $viewData['category']->getName())

@section('content')

<div class="mb-4">
    <h2>{{ $viewData['category']->getName() }}</h2>

    <p class="text-muted">
        {{ $viewData['category']->getDescription() }}
    </p>
</div>

<div class="row">
    @forelse ($viewData['category']->getProducts() as $product)
        <div class="col-md-4 col-lg-3 mb-4">
            <a
                href="{{ route('product.show', ['id' => $product->getId()]) }}"
                class="text-decoration-none text-reset"
            >
                <div class="card h-100 border-0 shadow-sm category-card">
                    <img
                        src="https://storage.googleapis.com/gamesense/{{ $product->getImage() }}"
                        alt="{{ $product->getTitle() }}"
                        class="card-img-top"
                        style="height: 300px; object-fit: cover;"
                    >

                    <div class="card-body text-center">
                        <h4 class="category-name">
                            {{ $product->getTitle() }}
                        </h4>

                        <p class="fw-bold mb-0">
                            {{ __('common.price_label') }} {{ __('common.money', ['amount' => number_format($product->getPrice(), 0, ',', '.')]) }}
                        </p>
                    </div>
                </div>
            </a>
        </div>
    @empty
        <div class="col-12">
            <p class="text-muted">
                {{ __('category/show.todavia_no_hay_productos') }}
            </p>
        </div>
    @endforelse
</div>

@endsection