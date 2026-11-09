
@extends('layouts.app')

@section('title', $viewData['title'])

@section('subtitle', __('category/index.explora_nuestras_categorias'))

@section('content')

<div class="row">
    @forelse ($viewData['categories'] as $category)
        <div class="col-md-4 col-lg-3 mb-4">
            <a
                href="{{ route('category.show', ['id' => $category->getId()]) }}"
                class="text-decoration-none text-reset"
            >
                <div class="card category-card h-100 border-0 shadow-sm">
                    <div class="category-cover d-flex align-items-center justify-content-center">
                        <h3 class="category-name text-center">
                            {{ $category->getName() }}
                        </h3>
                    </div>

                    <div class="card-body text-center">
                        <p class="card-text text-muted mb-0">
                            {{ $category->getDescription() }}
                        </p>
                    </div>
                </div>
            </a>
        </div>
    @empty
        <div class="col-12 text-center py-5">
            <h4>{{ __('category/index.no_hay_categorias_disponibles') }}</h4>
            <p class="text-muted">
                {{ __('category/index.todavia_no_hay_categorias') }}
            </p>
        </div>
    @endforelse
</div>

@endsection
