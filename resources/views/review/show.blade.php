@extends('layouts.app')

@section('title', $viewData['title'])

@section('subtitle', 'Reseña de ' . ($viewData['review']->getProduct()?->getTitle() ?? 'producto eliminado'))

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h4 class="mb-3">Detalles de la reseña</h4>

                <p>
                    <strong>Producto:</strong>
                    @if ($viewData['review']->getProduct())
                        <a
                            href="{{ route('product.show', ['id' => $viewData['review']->getProduct()->getId()]) }}"
                            class="text-decoration-none"
                        >
                            {{ $viewData['review']->getProduct()->getTitle() }}
                        </a>
                    @else
                        <span class="text-muted">Producto eliminado</span>
                    @endif
                </p>

                <p>
                    <strong>Usuario:</strong>
                    {{ $viewData['review']->getUser()?->getName() ?? 'Usuario eliminado' }}
                </p>

                <p>
                    <strong>Calificación:</strong>
                    {{ str_repeat('★', $viewData['review']->getRating()) }}{{ str_repeat('☆', 5 - $viewData['review']->getRating()) }}
                    ({{ $viewData['review']->getRating() }}/5)
                </p>

                <p>
                    <strong>Fecha:</strong>
                    {{ $viewData['review']->getDate()->format('d/m/Y') }}
                </p>

                <hr>

                <p>{{ $viewData['review']->getComment() }}</p>

                <div class="d-flex gap-2 mt-4">
                    <a href="{{ route('review.index') }}" class="btn btn-outline-secondary">
                        Volver a las reseñas
                    </a>

                    @auth
                        @if (Auth::id() === $viewData['review']->user_id || Auth::user()->getRole() === 'admin')
                            <form method="POST" action="{{ route('review.delete', ['id' => $viewData['review']->getId()]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">Eliminar reseña</button>
                            </form>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection