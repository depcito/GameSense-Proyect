@extends('admin.layout')

@section('title', 'Administrar categorías')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Administrar categorías</h2>

        <a href="{{ route('admin.category.create') }}" class="btn btn-primary">
            Crear categoría
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($viewData['categories'] as $category)
                            <tr>
                                <td>{{ $category->getId() }}</td>
                                <td>{{ $category->getName() }}</td>
                                <td>{{ $category->getDescription() }}</td>

                                <td>
                                    <div class="d-flex gap-2">

                                        <a href="{{ route('admin.category.show', ['id' => $category->getId()]) }}"
                                            class="btn btn-info btn-sm">
                                            Ver
                                        </a>

                                        <a href="{{ route('admin.category.edit', ['id' => $category->getId()]) }}"
                                            class="btn btn-warning btn-sm">
                                            Editar
                                        </a>

                                        <form action="{{ route('admin.category.destroy', ['id' => $category->getId()]) }}"
                                            method="POST"
                                            onsubmit="return confirm('¿Estás seguro de eliminar esta categoría?')">

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
                                <td colspan="4" class="text-center py-4">
                                    No hay categorías registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

@endsection
