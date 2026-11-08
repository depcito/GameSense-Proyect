
@extends('admin.layout')

@section('title', $viewData['title'])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Crear categoría</div>

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
                        action="{{ route('admin.category.save') }}"
                        enctype="multipart/form-data"
                    >
                        @csrf

                        <label for="name" class="form-label">Nombre</label>
                        <input
                            type="text"
                            class="form-control mb-3"
                            id="name"
                            name="name"
                            placeholder="Ingresa el nombre de la categoría"
                            value="{{ old('name') }}"
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

                        <label for="image" class="form-label">Imagen de la categoría</label>
                        <input
                            type="file"
                            class="form-control mb-3"
                            id="image"
                            name="image"
                            accept="image/jpeg,image/png,image/webp"
                        />

                        <button type="submit" class="btn btn-primary">
                            Crear categoría
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
