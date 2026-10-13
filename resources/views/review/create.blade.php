@extends('layouts.app')

@section('title', $viewData['title'])

@section('subtitle', 'Cuéntanos qué te pareció el producto')

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h4 class="mb-4">Nueva reseña</h4>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('review.save') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="product_id" class="form-label">Producto</label>
                        <select name="product_id" id="product_id" class="form-select" required>
                            <option value="">Selecciona un producto</option>
                            @foreach ($viewData['products'] as $product)
                                <option
                                    value="{{ $product->getId() }}"
                                    @selected(old('product_id', $viewData['selectedProductId']) == $product->getId())
                                >
                                    {{ $product->getTitle() }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="rating" class="form-label">Calificación</label>
                        <select name="rating" id="rating" class="form-select" required>
                            <option value="">Selecciona una calificación</option>
                            @for ($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}" @selected(old('rating') == $i)>
                                    {{ str_repeat('★', $i) }} ({{ $i }})
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="comment" class="form-label">Comentario</label>
                        <textarea
                            name="comment"
                            id="comment"
                            rows="4"
                            maxlength="1000"
                            class="form-control"
                            required
                        >{{ old('comment') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Publicar reseña</button>
                    <a href="{{ route('review.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection