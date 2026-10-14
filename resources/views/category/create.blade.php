@extends('layouts.app')
@section("title", $viewData["title"])
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Crear Categoria</div>
                <div class="card-body">
                    @if($errors->any())
                    <ul id="errors" class="alert alert-danger list-unstyled">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                    <form method="POST" action="{{ route('category.save') }}">

                        @csrf

                        <input type="text" class="form-control mb-2" placeholder="Ingresa el nombre de la categoria" name="name" value="{{ old('name') }}" />

                        <input type="text" class="form-control mb-2" placeholder="Ingresa una breve descripcion" name="description" value="{{ old('description') }}" />

                        <input type="submit" class="btn btn-primary" value="Crear nueva categoria" />

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection