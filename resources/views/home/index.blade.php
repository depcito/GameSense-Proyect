@extends('layouts.app')

@section('title', __('home/index.gamesense_inicio'))

@section('content')

<div class="home-banner mb-5">
    <h1>{{ __('home/index.bienvenido_a_gamesense') }}</h1>

    <p>
        {{ __('home/index.descubre_nuevos_videojuegos_y') }}
    </p>

    <a href="{{ route('product.index') }}" class="btn btn-light">
        {{ __('home/index.explorar_juegos') }}
    </a>

    <a href="{{ route('category.index') }}" class="btn btn-outline-light">
        {{ __('home/index.ver_categorias') }}
    </a>
</div>

<div class="mb-4">
    <h2>{{ __('home/index.juegos_destacados') }}</h2>
    <p class="text-muted">{{ __('home/index.algunos_juegos_que_puedes') }}</p>
</div>

<div class="row">
    @forelse ($viewData['featuredProducts'] as $product)
        <div class="col-md-6 col-lg-3 mb-4">
            <a href="{{ route('product.show', ['id' => $product->getId()]) }}"
                class="text-decoration-none text-reset">

                <div class="card category-card h-100">

                    <img src="{{ $product->getImageUrl() ?? asset('public/placeholder.png') }}"
                        alt="{{ $product->getTitle() }}"
                        class="card-img-top w-100"
                        style="aspect-ratio: 16 / 10; object-fit: cover;">

                    <div class="category-cover product-cover d-flex align-items-center justify-content-center px-2">
                        <h4 class="category-name text-center">
                            {{ $product->getTitle() }}
                        </h4>
                    </div>

                    <div class="card-body">
                        <p class="text-muted">
                            {{ $product->getCategory()?->getName() ?? __('common.no_category') }}
                        </p>

                        <p>
                            {{ $product->getDescription() }}
                        </p>

                        <strong>
                            {{ __('common.money', ['amount' => number_format($product->getPrice(), 0, ',', '.')]) }}
                        </strong>
                    </div>
                </div>
            </a>
        </div>
    @empty
        <p class="text-muted">{{ __('home/index.todavia_no_hay_juegos') }}</p>
    @endforelse
</div>

<div class="mb-4 mt-4">
    <h2>{{ __('home/index.explora_por_categoria') }}</h2>
    <p class="text-muted">{{ __('home/index.encuentra_juegos_segun_tus') }}</p>
</div>

<div class="row">
    @forelse ($viewData['categories'] as $category)
        <div class="col-md-6 col-lg-3 mb-4">
            <a href="{{ route('category.show', ['id' => $category->getId()]) }}"
                class="text-decoration-none text-reset">

                <div class="card category-card h-100">
                    <div class="card-body">
                        <h4>{{ $category->getName() }}</h4>

                        <p class="text-muted mb-0">
                            {{ $category->getDescription() }}
                        </p>
                    </div>
                </div>
            </a>
        </div>
    @empty
        <p class="text-muted">{{ __('home/index.todavia_no_hay_categorias') }}</p>
    @endforelse
</div>

@endsection