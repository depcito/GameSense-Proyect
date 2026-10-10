
@extends('layouts.app')

@section('title', $viewData['title'])

@section('subtitle', 'Explora nuestros productos')

@section('content')
<div class="row">
    @forelse ($viewData['products'] as $product)
        <div class="col-md-4 col-lg-3 mb-4">
            <a
                href="{{ route('product.show', ['id' => $product->getId()]) }}"
                class="text-decoration-none text-reset"
            >
                <div class="card category-card h-100 border-0 shadow-sm">
                    <div class="category-cover d-flex align-items-center justify-content-center">
                        <h3 class="category-name text-center">
                            {{ $product->getTitle() }}
                        </h3>
                    </div>

                    <div class="card-body text-center">
                        <p class="card-text text-muted">
                            {{ $product->getDescription() }}
                        </p>

                        <p class="fw-bold mb-1">
                            Precio: ${{ number_format($product->getPrice(), 2, ',', '.') }}
                        </p>

                        <p class="text-muted small mb-0">
                            Unidades disponibles: {{ $product->getStock() }}
                        </p>
                    </div>
                </div>
            </a>
        </div>
    @empty
        <div class="col-12 text-center py-5">
            <h4>No hay productos disponibles</h4>
            <p class="text-muted">
                Todavía no hay productos para mostrar.
            </p>
        </div>
    @endforelse
</div>
@endsection
