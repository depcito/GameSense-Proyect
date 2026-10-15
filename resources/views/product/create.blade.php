@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Crear producto</div>

                <div class="card-body">

                    @if($errors->any())
                        <ul id="errors" class="alert alert-danger list-unstyled">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <form method="POST" action="{{ route('product.save') }}">
                        @csrf

                        <label for="title" class="form-label">Nombre del producto</label>
                        <input
                            type="text"
                            class="form-control mb-3"
                            id="title"
                            name="title"
                            placeholder="Ingresa el nombre del producto"
                            value="{{ old('title') }}"
                            required
                        />

                        <label for="description" class="form-label">Descripción</label>
                        <textarea
                            class="form-control mb-3"
                            id="description"
                            name="description"
                            placeholder="Ingresa una breve descripción"
                            rows="3"
                            required
                        >{{ old('description') }}</textarea>

                        <label for="price" class="form-label">Precio (COP)</label>
                        <input
                            type="number"
                            class="form-control mb-3"
                            id="price"
                            name="price"
                            placeholder="Ej. 199900"
                            value="{{ old('price') }}"
                            min="0"
                            step="1"
                            required
                        />

                        <label for="stock" class="form-label">Cantidad disponible</label>
                        <input
                            type="number"
                            class="form-control mb-3"
                            id="stock"
                            name="stock"
                            placeholder="Ingresa la cantidad disponible"
                            value="{{ old('stock') }}"
                            min="0"
                            step="1"
                            required
                        />

                        <label for="format" class="form-label">Formato</label>
                        <select class="form-control mb-3" id="format" name="format" required>
                            <option value="">Selecciona un formato</option>
                            <option value="Fisico" {{ old('format') == 'Fisico' ? 'selected' : '' }}>
                                Físico
                            </option>
                            <option value="Digital" {{ old('format') == 'Digital' ? 'selected' : '' }}>
                                Digital
                            </option>
                        </select>

                        <label for="type" class="form-label">Tipo de producto</label>
                        <select class="form-control mb-3" id="type" name="type" required>
                            <option value="">Selecciona un tipo</option>
                            <option value="Videojuego" {{ old('type') == 'Videojuego' ? 'selected' : '' }}>
                                Videojuego
                            </option>
                            <option value="Tarjeta de saldo" {{ old('type') == 'Tarjeta de saldo' ? 'selected' : '' }}>
                                Tarjeta de saldo
                            </option>
                        </select>

                        <label for="platform" class="form-label">Plataforma</label>
                        <select class="form-control mb-3" id="platform" name="platform" required>
                            <option value="">Selecciona una plataforma</option>
                            <option value="PS5" {{ old('platform') == 'PS5' ? 'selected' : '' }}>
                                PS5
                            </option>
                            <option value="XBOX" {{ old('platform') == 'XBOX' ? 'selected' : '' }}>
                                Xbox
                            </option>
                            <option value="PC" {{ old('platform') == 'PC' ? 'selected' : '' }}>
                                PC
                            </option>
                            <option value="Nintendo Switch" {{ old('platform') == 'Nintendo Switch' ? 'selected' : '' }}>
                                Nintendo Switch
                            </option>
                        </select>

                        <label for="category_id" class="form-label">Categoría</label>
                        <select class="form-control mb-3" id="category_id" name="category_id" required>
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

                        <button type="submit" class="btn btn-primary">
                            Crear producto
                        </button>

                        <a href="{{ route('product.index') }}" class="btn btn-secondary">
                            Cancelar
                        </a>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
