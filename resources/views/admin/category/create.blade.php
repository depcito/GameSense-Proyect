
@extends('admin.layout')

@section('title', $viewData['title'])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('admin/category/create.crear_categoria') }}</div>

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

                        <label for="name" class="form-label">{{ __('common.nombre') }}</label>
                        <input
                            type="text"
                            class="form-control mb-3"
                            id="name"
                            name="name"
                            placeholder="{{ __('admin/category/create.ingresa_el_nombre_de') }}"
                            value="{{ old('name') }}"
                            required
                        />

                        <label for="description" class="form-label">{{ __('common.descripcion') }}</label>
                        <textarea
                            class="form-control mb-3"
                            id="description"
                            name="description"
                            placeholder="{{ __('admin/category/create.ingresa_una_breve_descripcion') }}"
                            rows="3"
                            required
                        >{{ old('description') }}</textarea>

                        <label for="image" class="form-label">{{ __('admin/category/create.imagen_de_la_categoria') }}</label>
                        <input
                            type="file"
                            class="form-control mb-3"
                            id="image"
                            name="image"
                            accept="image/jpeg,image/png,image/webp"
                        />

                        <button type="submit" class="btn btn-primary">
                            {{ __('admin/category/create.crear_categoria') }}
                        </button>

                        <a
                            href="{{ route('admin.category.index') }}"
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
