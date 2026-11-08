@extends('admin.layout')

@section('title', $viewData['title'])

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>{{ $viewData['product']->getTitle() }}</h2>

        <div class="d-flex gap-2">
            <a href="{{ route('admin.product.edit', ['id' => $viewData['product']->getId()]) }}"
                class="btn btn-warning">
                Editar producto
            </a>

            <a href="{{ route('admin.product.index') }}" class="btn btn-secondary">
                Volver
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <h5>Descripción</h5>
            <p class="text-muted">
                {{ $viewData['product']->getDescription() }}
            </p>

            <hr>

            <div class="row">
                <div class="col-md-6">
                    <p><strong>Precio:</strong> ${{ number_format($viewData['product']->getPrice(), 0, ',', '.') }} COP</p>
                    <p><strong>Stock:</strong> {{ $viewData['product']->getStock() }}</p>
                    <p><strong>Formato:</strong> {{ $viewData['product']->getFormat() }}</p>
                </div>

                <div class="col-md-6">
                    <p><strong>Tipo:</strong> {{ $viewData['product']->getType() }}</p>
                    <p><strong>Plataforma:</strong> {{ $viewData['product']->getPlatform() }}</p>
                    <p><strong>Categoría:</strong> {{ $viewData['product']->getCategory()->getName() }}</p>
                </div>
            </div>

        </div>
    </div>

</div>

@endsection