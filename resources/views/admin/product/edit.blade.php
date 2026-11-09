
@extends('admin.layout')

@section('title', $viewData['title'])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('admin/product/edit.editar_producto') }}</div>

                <div class="card-body">

                    @if($errors->any())
                        <ul class="alert alert-danger list-unstyled">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <form
                        method="POST"
                        action="{{ route('admin.product.update', ['id' => $viewData['product']->getId()]) }}"
                        enctype="multipart/form-data"
                    >
                        @csrf
                        @method('PUT')

                        <label for="title" class="form-label">{{ __('admin/product/edit.nombre_del_producto') }}</label>
                        <input
                            type="text"
                            class="form-control mb-3"
                            id="title"
                            name="title"
                            value="{{ old('title', $viewData['product']->getTitle()) }}"
                            required
                        />

                        <label for="description" class="form-label">{{ __('common.descripcion') }}</label>
                        <textarea
                            class="form-control mb-3"
                            id="description"
                            name="description"
                            rows="3"
                            required
                        >{{ old('description', $viewData['product']->getDescription()) }}</textarea>

                        <label for="price" class="form-label">{{ __('admin/product/edit.precio_cop') }}</label>
                        <input
                            type="number"
                            class="form-control mb-3"
                            id="price"
                            name="price"
                            value="{{ old('price', $viewData['product']->getPrice()) }}"
                            min="0"
                            step="0.01"
                            required
                        />

                        <label for="stock" class="form-label">{{ __('common.stock') }}</label>
                        <input
                            type="number"
                            class="form-control mb-3"
                            id="stock"
                            name="stock"
                            value="{{ old('stock', $viewData['product']->getStock()) }}"
                            min="0"
                            required
                        />

                        <label for="format" class="form-label">{{ __('common.formato') }}</label>
                        <input
                            type="text"
                            class="form-control mb-3"
                            id="format"
                            name="format"
                            value="{{ old('format', $viewData['product']->getFormat()) }}"
                            required
                        />

                        <label for="type" class="form-label">{{ __('common.tipo') }}</label>
                        <input
                            type="text"
                            class="form-control mb-3"
                            id="type"
                            name="type"
                            value="{{ old('type', $viewData['product']->getType()) }}"
                            required
                        />

                        <label for="platform" class="form-label">{{ __('common.plataforma') }}</label>
                        <input
                            type="text"
                            class="form-control mb-3"
                            id="platform"
                            name="platform"
                            value="{{ old('platform', $viewData['product']->getPlatform()) }}"
                            required
                        />

                        <label for="category_id" class="form-label">{{ __('admin/product/edit.categoria') }}</label>
                        <select
                            class="form-control mb-3"
                            id="category_id"
                            name="category_id"
                            required
                        >
                            <option value="">{{ __('admin/product/edit.selecciona_una_categoria') }}</option>

                            @foreach($viewData['categories'] as $category)
                                <option
                                    value="{{ $category->getId() }}"
                                    {{ old('category_id', $viewData['product']->category_id) == $category->getId() ? 'selected' : '' }}
                                >
                                    {{ $category->getName() }}
                                </option>
                            @endforeach
                        </select>

                        @if($viewData['product']->getImageUrl())
                            <div class="mb-3">
                                <p>{{ __('admin/product/edit.imagen_actual') }}</p>

                                <img
                                    src="{{ $viewData['product']->getImageUrl() }}"
                                    alt="{{ $viewData['product']->getTitle() }}"
                                    style="width: 180px; height: 150px; object-fit: cover;"
                                />
                            </div>
                        @endif

                        <label for="image" class="form-label">
                            {{ __('admin/product/edit.seleccionar_nueva_imagen') }}
                        </label>

                        <input
                            type="file"
                            class="form-control mb-3"
                            id="image"
                            name="image"
                            accept="image/jpeg,image/png,image/webp"
                        />

                        <button type="submit" class="btn btn-primary">
                            {{ __('admin/product/edit.actualizar_producto') }}
                        </button>

                        <a
                            href="{{ route('admin.product.index') }}"
                            class="btn btn-secondary"
                        >
                            {{ __('common.cancelar') }}
                        </a>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
