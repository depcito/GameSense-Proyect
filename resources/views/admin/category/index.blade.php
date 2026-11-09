
@extends('admin.layout')

@section('title', __('admin/category/index.administrar_categorias'))

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>{{ __('admin/category/index.administrar_categorias') }}</h2>

        <a href="{{ route('admin.category.create') }}" class="btn btn-primary">
            {{ __('admin/category/index.crear_categoria') }}
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle">

                    <thead>
                        <tr>
                            <th>{{ __('common.id') }}</th>
                            <th>{{ __('admin/category/index.imagen') }}</th>
                            <th>{{ __('common.nombre') }}</th>
                            <th>{{ __('common.descripcion') }}</th>
                            <th>{{ __('common.acciones') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($viewData['categories'] as $category)
                            <tr>
                                <td>{{ $category->getId() }}</td>

                                <td>
                                    @if($category->getImageUrl())
                                        <img
                                            src="{{ $category->getImageUrl() }}"
                                            alt="{{ $category->getName() }}"
                                            style="width: 80px; height: 70px; object-fit: cover;"
                                            class="rounded"
                                        />
                                    @else
                                        <span class="text-muted">
                                            {{ __('admin/category/index.sin_imagen') }}
                                        </span>
                                    @endif
                                </td>

                                <td>{{ $category->getName() }}</td>

                                <td>{{ $category->getDescription() }}</td>

                                <td>
                                    <div class="d-flex gap-2">

                                        <a
                                            href="{{ route('admin.category.show', ['id' => $category->getId()]) }}"
                                            class="btn btn-info btn-sm"
                                        >
                                            {{ __('common.ver') }}
                                        </a>

                                        <a
                                            href="{{ route('admin.category.edit', ['id' => $category->getId()]) }}"
                                            class="btn btn-warning btn-sm"
                                        >
                                            {{ __('common.editar') }}
                                        </a>

                                        <form
                                            action="{{ route('admin.category.destroy', ['id' => $category->getId()]) }}"
                                            method="POST"
                                            onsubmit="return confirm(@js(__('admin/category/index.confirm_delete')))"
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
                                <td colspan="5" class="text-center py-4">
                                    {{ __('admin/category/index.no_hay_categorias_registradas') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            <div class="mt-3">
                {{ $viewData['categories']->links() }}
            </div>

        </div>
    </div>

</div>

@endsection
