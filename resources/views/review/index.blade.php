@extends('layouts.app')

@section('title', $viewData['title'])

@section('subtitle', $viewData['product'] ? __('review/index.reviews_of', ['product' => $viewData['product']->getTitle()]) : __('review/index.reviews_of_our_products'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="mb-0">
        @if ($viewData['product'])
            {{ __('review/index.reviews_of', ['product' => $viewData['product']->getTitle()]) }}
        @else
            {{ __('review/index.all_reviews') }}
        @endif
    </h3>

    @auth
        <a
            href="{{ route('review.create', $viewData['product'] ? ['product_id' => $viewData['product']->getId()] : []) }}"
            class="btn btn-primary"
        >
            {{ __('review/index.escribir_resena') }}
        </a>
    @endauth
</div>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

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
                                {{ $review->getProduct()?->getTitle() ?? __('common.product_deleted') }}
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
                        {{ __('review/index.by_user', ['user' => $review->getUser()?->getName() ?? __('common.user_deleted')]) }}
                        · {{ $review->getDate()->format('d/m/Y') }}
                    </p>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center py-5">
            <h4>{{ __('review/index.no_hay_resenas_disponibles') }}</h4>
            <p class="text-muted">
                {{ __('review/index.todavia_no_hay_resenas') }}
            </p>
        </div>
    @endforelse
</div>
@endsection