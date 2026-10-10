
@extends('layouts.app')

@section('title', $viewData['title'])

@section('subtitle', $viewData['product']->getTitle())

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card category-card border-0 shadow-sm">
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
                    ${{ number_format($viewData['product']->getPrice(), 2, ',', '.') }}
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
                            href="{{ route('categories.show', ['id' => $viewData['product']->getCategory()->getId()]) }}"
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
