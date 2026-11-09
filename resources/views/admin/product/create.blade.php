
@extends('admin.layout')

@section('title', $viewData['title'])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('admin/product/create.crear_producto') }}</div>

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
                        action="{{ route('admin.product.save') }}"
                        enctype="multipart/form-data"
                    >
                        @csrf

                        <label for="title" class="form-label">{{ __('admin/product/create.nombre_del_producto') }}</label>
                        <input
                            type="text"
                            class="form-control mb-3"
                            id="title"
                            name="title"
                            value="{{ old('title') }}"
                            placeholder="{{ __('admin/product/create.ingresa_el_nombre_del') }}"
                            required
                        />

                        <label for="description" class="form-label">{{ __('common.descripcion') }}</label>
                        <textarea
                            class="form-control mb-3"
                            id="description"
                            name="description"
                            rows="3"
                            placeholder="{{ __('admin/product/create.ingresa_una_descripcion') }}"
                            required
                        >{{ old('description') }}</textarea>

                        <label for="price" class="form-label">{{ __('admin/product/create.precio_cop') }}</label>
                        <input
                            type="number"
                            class="form-control mb-3"
                            id="price"
                            name="price"
                            value="{{ old('price') }}"
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
                            value="{{ old('stock') }}"
                            min="0"
                            required
                        />

                        <label for="format" class="form-label">{{ __('common.formato') }}</label>
                        <input
                            type="text"
                            class="form-control mb-3"
                            id="format"
                            name="format"
                            value="{{ old('format') }}"
                            placeholder="{{ __('admin/product/create.formato_del_producto') }}"
                            required
                        />

                        <label for="type" class="form-label">{{ __('common.tipo') }}</label>
                        <input
                            type="text"
                            class="form-control mb-3"
                            id="type"
                            name="type"
                            value="{{ old('type') }}"
                            placeholder="{{ __('admin/product/create.tipo_de_producto') }}"
                            required
                        />

                        <label for="platform" class="form-label">{{ __('common.plataforma') }}</label>
                        <input
                            type="text"
                            class="form-control mb-3"
                            id="platform"
                            name="platform"
                            value="{{ old('platform') }}"
                            placeholder="{{ __('common.plataforma') }}"
                            required
                        />

                        <label for="category_id" class="form-label">{{ __('admin/product/create.categoria') }}</label>
                        <select
                            class="form-control mb-3"
                            id="category_id"
                            name="category_id"
                            required
                        >
                            <option value="">{{ __('admin/product/create.selecciona_una_categoria') }}</option>

                            @foreach($viewData['categories'] as $category)
                                <option
                                    value="{{ $category->getId() }}"
                                    {{ old('category_id') == $category->getId() ? 'selected' : '' }}
                                >
                                    {{ $category->getName() }}
                                </option>
                            @endforeach
                        </select>

                        <label for="image" class="form-label">{{ __('admin/product/create.imagen_del_producto') }}</label>
                        <input
                            type="file"
                            class="form-control mb-3"
                            id="image"
                            name="image"
                            accept="image/jpeg,image/png,image/webp"
                        />

                        <button type="submit" class="btn btn-primary">
                            {{ __('admin/product/create.crear_producto') }}
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
