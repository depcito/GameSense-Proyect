
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

            <a href="{{ route('product.show', ['id' => $product->getId()]) }}"
               class="text-decoration-none text-reset">

                <div class="card h-100 border-0 shadow-sm category-card">

                    <div class="category-cover d-flex align-items-center justify-content-center">
                        <h4 class="category-name text-center">
                            {{ $product->getName() }}
                        </h4>
                    </div>

                    <div class="card-body text-center">
                        <p class="mb-0">
                            Price: ${{ $product->getPrice() }}
                        </p>
                    </div>

                </div>

            </a>

        </div>

    @empty

        <div class="col-12">
            <p class="text-muted">
                There are no products in this category yet.
            </p>
        </div>

    @endforelse

</div>

@endsection
