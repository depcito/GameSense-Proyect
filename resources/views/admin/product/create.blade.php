
@extends('admin.layout')

@section('title', $viewData['title'])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Crear producto</div>

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

                        <label for="title" class="form-label">Nombre del producto</label>
                        <input
                            type="text"
                            class="form-control mb-3"
                            id="title"
                            name="title"
                            value="{{ old('title') }}"
                            placeholder="Ingresa el nombre del producto"
                            required
                        />

                        <label for="description" class="form-label">Descripción</label>
                        <textarea
                            class="form-control mb-3"
                            id="description"
                            name="description"
                            rows="3"
                            placeholder="Ingresa una descripción"
                            required
                        >{{ old('description') }}</textarea>

                        <label for="price" class="form-label">Precio (COP)</label>
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

                        <label for="stock" class="form-label">Stock</label>
                        <input
                            type="number"
                            class="form-control mb-3"
                            id="stock"
                            name="stock"
                            value="{{ old('stock') }}"
                            min="0"
                            required
                        />

                        <label for="format" class="form-label">Formato</label>
                        <input
                            type="text"
                            class="form-control mb-3"
                            id="format"
                            name="format"
                            value="{{ old('format') }}"
                            placeholder="Formato del producto"
                            required
                        />

                        <label for="type" class="form-label">Tipo</label>
                        <input
                            type="text"
                            class="form-control mb-3"
                            id="type"
                            name="type"
                            value="{{ old('type') }}"
                            placeholder="Tipo de producto"
                            required
                        />

                        <label for="platform" class="form-label">Plataforma</label>
                        <input
                            type="text"
                            class="form-control mb-3"
                            id="platform"
                            name="platform"
                            value="{{ old('platform') }}"
                            placeholder="Plataforma"
                            required
                        />

                        <label for="category_id" class="form-label">Categoría</label>
                        <select
                            class="form-control mb-3"
                            id="category_id"
                            name="category_id"
                            required
                        >
                            <option value="">Selecciona una categoría</option>

                            @foreach($viewData['categories'] as $category)
                                <option
                                    value="{{ $category->getId() }}"
                                    {{ old('category_id') == $category->getId() ? 'selected' : '' }}
                                >
                                    {{ $category->getName() }}
                                </option>
                            @endforeach
                        </select>

                        <label for="image" class="form-label">Imagen del producto</label>
                        <input
                            type="file"
                            class="form-control mb-3"
                            id="image"
                            name="image"
                            accept="image/jpeg,image/png,image/webp"
                        />

                        <button type="submit" class="btn btn-primary">
                            Crear producto
                        </button>

                        <a
                            href="{{ route('admin.product.index') }}"
                            class="btn btn-secondary"
                        >
                            Cancelar
                        </a>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
