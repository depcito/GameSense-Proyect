@extends('layouts.app')

@section('title', $viewData['title'])

@section('subtitle', __('review/show.review_of', ['product' => $viewData['review']->getProduct()?->getTitle() ?? __('common.product_deleted')]))

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h4 class="mb-3">{{ __('review/show.detalles_de_la_resena') }}</h4>

                <p>
                    <strong>{{ __('review/show.producto') }}</strong>
                    @if ($viewData['review']->getProduct())
                        <a
                            href="{{ route('product.show', ['id' => $viewData['review']->getProduct()->getId()]) }}"
                            class="text-decoration-none"
                        >
                            {{ $viewData['review']->getProduct()->getTitle() }}
                        </a>
                    @else
                        <span class="text-muted">{{ __('review/show.producto_eliminado') }}</span>
                    @endif
                </p>

                <p>
                    <strong>{{ __('common.usuario_label') }}</strong>
                    {{ $viewData['review']->getUser()?->getName() ?? __('common.user_deleted') }}
                </p>

                <p>
                    <strong>{{ __('review/show.calificacion') }}</strong>
                    {{ str_repeat('★', $viewData['review']->getRating()) }}{{ str_repeat('☆', 5 - $viewData['review']->getRating()) }}
                    ({{ $viewData['review']->getRating() }}/5)
                </p>

                <p>
                    <strong>{{ __('common.fecha_label') }}</strong>
                    {{ $viewData['review']->getDate()->format('d/m/Y') }}
                </p>

                <hr>

                <p>{{ $viewData['review']->getComment() }}</p>

                <div class="d-flex gap-2 mt-4">
                    <a
                        href="{{ route('review.index', $viewData['review']->getProduct() ? ['product_id' => $viewData['review']->getProduct()->getId()] : []) }}"
                        class="btn btn-outline-secondary"
                    >
                        {{ __('review/show.volver_a_las_resenas') }}
                    </a>

                    @auth
                        @if (Auth::id() === $viewData['review']->user_id)
                            <form method="POST" action="{{ route('review.delete', ['id' => $viewData['review']->getId()]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">{{ __('review/show.eliminar_resena') }}</button>
                            </form>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection