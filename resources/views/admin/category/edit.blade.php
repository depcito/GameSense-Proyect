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
                        <ul id="errors" class="alert alert-danger list-unstyled">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <form method="POST" action="{{ route('admin.category.update', ['id' => $viewData['category']->getId()]) }}">

                        @csrf
                        @method('PUT')

                        <input
                            type="text"
                            class="form-control mb-2"
                            placeholder="Ingresa el nombre de la categoría"
                            name="name"
                            value="{{ old('name', $viewData['category']->getName()) }}"
                        />

                        <input
                            type="text"
                            class="form-control mb-2"
                            placeholder="Ingresa una breve descripción"
                            name="description"
                            value="{{ old('description', $viewData['category']->getDescription()) }}"
                        />

                        <input
                            type="submit"
                            class="btn btn-primary"
                            value="Actualizar categoría"
                        />

                        <a href="{{ route('admin.category.index') }}" class="btn btn-secondary">
                            Cancelar
                        </a>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection