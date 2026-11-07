@extends('admin.layout')

@section('title', $viewData['title'])

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">Editar producto</div>

                <div class="card-body">

                    @if($errors->any())
                        <ul id="errors" class="alert alert-danger list-unstyled">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <form method="POST" action="{{ route('admin.product.update', ['id' => $viewData['product']->getId()]) }}">

                        @csrf
                        @method('PUT')

                        <input
                            type="text"
                            class="form-control mb-2"
                            placeholder="Ingresa el nombre del producto"
                            name="title"
                            value="{{ old('title', $viewData['product']->getTitle()) }}"
                        />

                        <textarea
                            class="form-control mb-2"
                            placeholder="Ingresa una descripción"
                            name="description"
                            rows="3"
                        >{{ old('description', $viewData['product']->getDescription()) }}</textarea>

                        <input
                            type="number"
                            step="0.01"
                            min="0"
                            class="form-control mb-2"
                            placeholder="Precio"
                            name="price"
                            value="{{ old('price', $viewData['product']->getPrice()) }}"
                        />

                        <input
                            type="number"
                            min="0"
                            class="form-control mb-2"
                            placeholder="Stock"
                            name="stock"
                            value="{{ old('stock', $viewData['product']->getStock()) }}"
                        />

                        <input
                            type="text"
                            class="form-control mb-2"
                            placeholder="Formato"
                            name="format"
                            value="{{ old('format', $viewData['product']->getFormat()) }}"
                        />

                        <input
                            type="text"
                            class="form-control mb-2"
                            placeholder="Tipo"
                            name="type"
                            value="{{ old('type', $viewData['product']->getType()) }}"
                        />

                        <input
                            type="text"
                            class="form-control mb-2"
                            placeholder="Plataforma"
                            name="platform"
                            value="{{ old('platform', $viewData['product']->getPlatform()) }}"
                        />

                        <select name="category_id" class="form-control mb-3">
                            <option value="">Selecciona una categoría</option>

                            @foreach($viewData['categories'] as $category)
                                <option
                                    value="{{ $category->getId() }}"
                                    {{ old('category_id', $viewData['product']->category_id) == $category->getId() ? 'selected' : '' }}
                                >
                                    {{ $category->getName() }}
                                </option>
                            @endforeach
                        </select>

                        <input
                            type="submit"
                            class="btn btn-primary"
                            value="Actualizar producto"
                        />

                        <a href="{{ route('admin.product.index') }}" class="btn btn-secondary">
                            Cancelar
                        </a>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection