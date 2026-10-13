@extends('layouts.app')

@section('title', $viewData['title'])

@section('subtitle', $viewData['product'] ? 'Reseñas de ' . $viewData['product']->getTitle() : 'Reseñas de nuestros productos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="mb-0">
        @if ($viewData['product'])
            Reseñas de {{ $viewData['product']->getTitle() }}
        @else
            Todas las reseñas
        @endif
    </h3>

    @auth
        <a
            href="{{ route('review.create', $viewData['product'] ? ['product_id' => $viewData['product']->getId()] : []) }}"
            class="btn btn-primary"
        >
            Escribir reseña
        </a>
    @endauth
</div>

<div class="row">
    @forelse ($viewData['reviews'] as $review)
        <div class="col-md-6 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-title mb-1">
                            <a
                                href="{{ route('review.show', ['id' => $review->getId()]) }}"
                                class="text-decoration-none"
                            >
                                {{ $review->getProduct()?->getTitle() ?? 'Producto eliminado' }}
                            </a>
                        </h5>
                        <span class="fw-bold">
                            {{ str_repeat('★', $review->getRating()) }}{{ str_repeat('☆', 5 - $review->getRating()) }}
                        </span>
                    </div>

                    <p class="card-text mt-2">
                        {{ $review->getComment() }}
                    </p>

                    <p class="text-muted small mb-0">
                        Por {{ $review->getUser()?->getName() ?? 'Usuario eliminado' }}
                        · {{ $review->getDate()->format('d/m/Y') }}
                    </p>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center py-5">
            <h4>No hay reseñas disponibles</h4>
            <p class="text-muted">
                Todavía no hay reseñas para mostrar.
            </p>
        </div>
    @endforelse
</div>
@endsection