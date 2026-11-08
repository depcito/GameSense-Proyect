
@extends('admin.layout')

@section('title', $viewData['title'])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar categoría</div>

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
                        action="{{ route('admin.category.update', ['id' => $viewData['category']->getId()]) }}"
                        enctype="multipart/form-data"
                    >
                        @csrf
                        @method('PUT')

                        <label for="name" class="form-label">Nombre</label>
                        <input
                            type="text"
                            class="form-control mb-3"
                            id="name"
                            name="name"
                            value="{{ old('name', $viewData['category']->getName()) }}"
                            required
                        />

                        <label for="description" class="form-label">Descripción</label>
                        <textarea
                            class="form-control mb-3"
                            id="description"
                            name="description"
                            rows="3"
                            required
                        >{{ old('description', $viewData['category']->getDescription()) }}</textarea>

                        @if($viewData['category']->getImageUrl())
                            <div class="mb-3">
                                <p>Imagen actual:</p>

                                <img
                                    src="{{ $viewData['category']->getImageUrl() }}"
                                    alt="{{ $viewData['category']->getName() }}"
                                    style="width: 180px; height: 150px; object-fit: cover;"
                                />
                            </div>
                        @endif

                        <label for="image" class="form-label">
                            Seleccionar nueva imagen
                        </label>

                        <input
                            type="file"
                            class="form-control mb-3"
                            id="image"
                            name="image"
                            accept="image/jpeg,image/png,image/webp"
                        />

                        <button type="submit" class="btn btn-primary">
                            Actualizar categoría
                        </button>

                        <a
                            href="{{ route('admin.category.index') }}"
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
