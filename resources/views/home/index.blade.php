
@extends('layouts.app')

@section('title', 'GameSense - Inicio')

@section('content')

<div class="home-banner mb-5">
    <h1>Bienvenido a Gamesense</h1>

    <p>
        Descubre nuevos videojuegos y encuentra eso que tanto deseas.
    </p>

    <a href="{{ route('product.index') }}" class="btn btn-light">
        Explorar juegos
    </a>

    <a href="{{ route('category.index') }}" class="btn btn-outline-light">
        Ver categorías
    </a>
</div>

<div class="mb-4">
    <h2>Juegos destacados</h2>
    <p class="text-muted">Algunos juegos que puedes encontrar en nuestra tienda.</p>
</div>

<div class="row">
    @forelse ($viewData['featuredProducts'] as $product)
        <div class="col-md-6 col-lg-3 mb-4">
            <a href="{{ route('product.show', ['id' => $product->getId()]) }}"
                class="text-decoration-none text-reset">

                <div class="card category-card h-100">
                    <div class="category-cover d-flex align-items-center justify-content-center">
                        <h4 class="category-name text-center">
                            {{ $product->getTitle() }}
                        </h4>
                    </div>

                    <div class="card-body">
                        <p class="text-muted">
                            {{ $product->getCategory()?->getName() ?? 'Sin categoría' }}
                        </p>

                        <p>
                            {{ $product->getDescription() }}
                        </p>

                        <strong>
                            ${{ number_format($product->getPrice(), 0, ',', '.') }} COP
                        </strong>
                    </div>
                </div>
            </a>
        </div>
    @empty
        <p class="text-muted">Todavía no hay juegos disponibles.</p>
    @endforelse
</div>

<div class="mb-4 mt-4">
    <h2>Explora por categoría</h2>
    <p class="text-muted">Encuentra juegos según tus gustos.</p>
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
        <p class="text-muted">Todavía no hay categorías disponibles.</p>
    @endforelse
</div>

@endsection
