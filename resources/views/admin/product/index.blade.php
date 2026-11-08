
@extends('admin.layout')

@section('title', 'Administrar productos')

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Administrar productos</h2>

        <a href="{{ route('admin.product.create') }}" class="btn btn-primary">
            Crear producto
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Imagen</th>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Formato</th>
                            <th>Tipo</th>
                            <th>Plataforma</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($viewData['products'] as $product)
                            <tr>
                                <td>{{ $product->getId() }}</td>

                                <td>
                                    @if($product->getImageUrl())
                                        <img
                                            src="{{ $product->getImageUrl() }}"
                                            alt="{{ $product->getTitle() }}"
                                            style="width: 80px; height: 70px; object-fit: cover;"
                                            class="rounded"
                                        />
                                    @else
                                        <span class="text-muted">
                                            Sin imagen
                                        </span>
                                    @endif
                                </td>

                                <td>{{ $product->getTitle() }}</td>

                                <td>
                                    ${{ number_format($product->getPrice(), 0, ',', '.') }} COP
                                </td>

                                <td>{{ $product->getStock() }}</td>

                                <td>{{ $product->getFormat() }}</td>

                                <td>{{ $product->getType() }}</td>

                                <td>{{ $product->getPlatform() }}</td>

                                <td>
                                    <div class="d-flex gap-2">

                                        <a
                                            href="{{ route('admin.product.show', ['id' => $product->getId()]) }}"
                                            class="btn btn-info btn-sm"
                                        >
                                            Ver
                                        </a>

                                        <a
                                            href="{{ route('admin.product.edit', ['id' => $product->getId()]) }}"
                                            class="btn btn-warning btn-sm"
                                        >
                                            Editar
                                        </a>

                                        <form
                                            action="{{ route('admin.product.destroy', ['id' => $product->getId()]) }}"
                                            method="POST"
                                            onsubmit="return confirm('¿Estás seguro de eliminar este producto?')"
                                        >
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
                                <td colspan="9" class="text-center py-4">
                                    No hay productos registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            <div class="mt-3">
                {{ $viewData['products']->links() }}
            </div>

        </div>
    </div>

</div>

@endsection
