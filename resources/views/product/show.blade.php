
@extends('layouts.app')

@section('title', $viewData['title'])

@section('subtitle', $viewData['product']->getTitle())

@section('content')

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card category-card border-0 shadow-sm">

            @if ($viewData['product']->getImageUrl())
                <img
                    src="{{ $viewData['product']->getImageUrl() }}"
                    alt="{{ $viewData['product']->getTitle() }}"
                    class="card-img-top"
                    style="max-height: 400px; object-fit: contain;"
                >
            @endif

            <div class="category-cover d-flex align-items-center justify-content-center">
                <h2 class="category-name text-center">
                    {{ $viewData['product']->getTitle() }}
                </h2>
            </div>

            <div class="card-body p-4">

                <h4 class="mb-3">Detalles del producto</h4>

                <p class="text-muted">
                    {{ $viewData['product']->getDescription() }}
                </p>

                <hr>

                <p>
                    <strong>Precio:</strong>
                    ${{ number_format($viewData['product']->getPrice(), 0, ',', '.') }} COP
                </p>

                <p>
                    <strong>Unidades disponibles:</strong>
                    {{ $viewData['product']->getStock() }}
                </p>

                <p>
                    <strong>Formato:</strong>
                    {{ $viewData['product']->getFormat() }}
                </p>

                <p>
                    <strong>Tipo:</strong>
                    {{ $viewData['product']->getType() }}
                </p>

                <p>
                    <strong>Plataforma:</strong>
                    {{ $viewData['product']->getPlatform() }}
                </p>

                <p>
                    <strong>Categoría:</strong>

                    @if ($viewData['product']->getCategory())
                        <a
                            href="{{ route('category.show', ['id' => $viewData['product']->getCategory()->getId()]) }}"
                            class="text-decoration-none"
                        >
                            {{ $viewData['product']->getCategory()->getName() }}
                        </a>
                    @else
                        <span class="text-muted">
                            Sin categoría asignada
                        </span>
                    @endif
                </p>

                <hr>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @auth
                    @if ($viewData['product']->getStock() > 0)
                        <form
                            method="POST"
                            action="{{ route('cart.add', ['id' => $viewData['product']->getId()]) }}"
                            class="row g-2 align-items-end mb-3"
                        >
                            @csrf

                            <div class="col-auto">
                                <label for="quantity" class="form-label">Cantidad</label>
                                <input
                                    type="number"
                                    name="quantity"
                                    id="quantity"
                                    class="form-control"
                                    value="1"
                                    min="1"
                                    max="{{ $viewData['product']->getStock() }}"
                                    required
                                >
                            </div>

                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary">
                                    Agregar al carrito
                                </button>
                            </div>
                        </form>
                    @else
                        <p class="text-muted">
                            Producto agotado.
                        </p>
                    @endif
                @else
                    <p class="text-muted">
                        <a href="{{ route('login') }}" class="text-decoration-none">Inicia sesión</a>
                        para agregar este producto al carrito.
                    </p>
                @endauth

                <hr>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">
                        Reseñas
                        @if ($viewData['reviewsCount'] > 0)
                            <span class="text-muted small">
                                · {{ number_format($viewData['averageRating'], 1) }}/5
                                ({{ $viewData['reviewsCount'] }})
                            </span>
                        @endif
                    </h5>

                    <div class="d-flex gap-2">
                        <a
                            href="{{ route('review.index', ['product_id' => $viewData['product']->getId()]) }}"
                            class="btn btn-outline-secondary btn-sm"
                        >
                            Ver todas
                        </a>

                        @auth
                            <a
                                href="{{ route('review.create', ['product_id' => $viewData['product']->getId()]) }}"
                                class="btn btn-primary btn-sm"
                            >
                                Escribir reseña
                            </a>
                        @endauth
                    </div>
                </div>

                @forelse ($viewData['reviews'] as $review)
                    <div class="border-bottom border-secondary py-2">
                        <div class="d-flex justify-content-between">
                            <span class="fw-bold">{{ $review->getUser()?->getName() ?? 'Usuario eliminado' }}</span>
                            <span>
                                {{ str_repeat('★', $review->getRating()) }}{{ str_repeat('☆', 5 - $review->getRating()) }}
                            </span>
                        </div>

                        <p class="mb-0">{{ $review->getComment() }}</p>
                    </div>
                @empty
                    <p class="text-muted">
                        Este producto todavía no tiene reseñas.
                    </p>
                @endforelse

                <a
                    href="{{ route('product.index') }}"
                    class="btn btn-outline-secondary mt-3"
                >
                    Volver a los productos
                </a>

            </div>
        </div>
    </div>
</div>

@endsection
