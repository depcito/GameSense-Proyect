@extends('admin.layout')

@section('title', 'Administrar reseñas')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Administrar reseñas</h2>
    </div>

    <form method="GET" action="{{ route('admin.review.index') }}" class="row g-2 mb-3">
        <div class="col-sm-8 col-md-6">
            <input type="text" name="search" value="{{ $viewData['search'] }}" class="form-control"
                placeholder="Buscar por comentario, producto o usuario">
        </div>
        <div class="col-auto">
            <button class="btn btn-secondary" type="submit">Buscar</button>
            @if ($viewData['search'] !== '')
                <a href="{{ route('admin.review.index') }}" class="btn btn-link">Limpiar</a>
            @endif
        </div>
    </form>

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Producto</th>
                            <th>Usuario</th>
                            <th>Calificación</th>
                            <th>Comentario</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($viewData['reviews'] as $review)
                            <tr>
                                <td>{{ $review->getId() }}</td>
                                <td>{{ $review->getProduct()?->getTitle() ?? 'Producto eliminado' }}</td>
                                <td>{{ $review->getUser()?->getName() ?? 'Usuario eliminado' }}</td>
                                <td>{{ $review->getRating() }}/5</td>
                                <td>{{ \Illuminate\Support\Str::limit($review->getComment(), 60) }}</td>
                                <td>{{ $review->getDate()->format('d/m/Y') }}</td>

                                <td>
                                    <div class="d-flex gap-2">

                                        <a href="{{ route('review.show', ['id' => $review->getId()]) }}"
                                            class="btn btn-info btn-sm">
                                            Ver
                                        </a>

                                        <form action="{{ route('admin.review.destroy', ['id' => $review->getId()]) }}"
                                            method="POST"
                                            onsubmit="return confirm('¿Estás seguro de eliminar esta reseña?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm">
                                                Eliminar
                                            </button>

                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    No hay reseñas registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            {{ $viewData['reviews']->links() }}

        </div>
    </div>

</div>

@endsection
