
@extends('admin.layout')

@section('title', __('admin/product/index.administrar_productos'))

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>{{ __('admin/product/index.administrar_productos') }}</h2>

        <a href="{{ route('admin.product.create') }}" class="btn btn-primary">
            {{ __('admin/product/index.crear_producto') }}
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle">

                    <thead>
                        <tr>
                            <th>{{ __('common.id') }}</th>
                            <th>{{ __('admin/product/index.imagen') }}</th>
                            <th>{{ __('common.producto') }}</th>
                            <th>{{ __('admin/product/index.precio') }}</th>
                            <th>{{ __('common.stock') }}</th>
                            <th>{{ __('common.formato') }}</th>
                            <th>{{ __('common.tipo') }}</th>
                            <th>{{ __('common.plataforma') }}</th>
                            <th>{{ __('common.acciones') }}</th>
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
                                            {{ __('admin/product/index.sin_imagen') }}
                                        </span>
                                    @endif
                                </td>

                                <td>{{ $product->getTitle() }}</td>

                                <td>
                                    {{ __('common.money', ['amount' => number_format($product->getPrice(), 0, ',', '.')]) }}
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
                                            {{ __('common.ver') }}
                                        </a>

                                        <a
                                            href="{{ route('admin.product.edit', ['id' => $product->getId()]) }}"
                                            class="btn btn-warning btn-sm"
                                        >
                                            {{ __('common.editar') }}
                                        </a>

                                        <form
                                            action="{{ route('admin.product.destroy', ['id' => $product->getId()]) }}"
                                            method="POST"
                                            onsubmit="return confirm(@js(__('admin/product/index.confirm_delete')))"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm">
                                                {{ __('common.eliminar') }}
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-4">
                                    {{ __('admin/product/index.no_hay_productos_registrados') }}
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
