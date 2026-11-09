@extends('layouts.app')

@section('title', $viewData['title'])

@section('subtitle', __('review/create.cuentanos_que_te_parecio'))

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h4 class="mb-4">{{ __('review/create.nueva_resena') }}</h4>

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
                        <label for="product_id" class="form-label">{{ __('common.producto') }}</label>
                        <select name="product_id" id="product_id" class="form-select" required>
                            <option value="">{{ __('review/create.selecciona_un_producto') }}</option>
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
                        <label for="rating" class="form-label">{{ __('review/create.calificacion') }}</label>
                        <select name="rating" id="rating" class="form-select" required>
                            <option value="">{{ __('review/create.selecciona_una_calificacion') }}</option>
                            @for ($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}" @selected(old('rating') == $i)>
                                    {{ str_repeat('★', $i) }} ({{ $i }})
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="comment" class="form-label">{{ __('review/create.comentario') }}</label>
                        <textarea
                            name="comment"
                            id="comment"
                            rows="4"
                            maxlength="1000"
                            class="form-control"
                            required
                        >{{ old('comment') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">{{ __('review/create.publicar_resena') }}</button>
                    <a
                        href="{{ $viewData['selectedProductId'] ? route('product.show', ['id' => $viewData['selectedProductId']]) : route('product.index') }}"
                        class="btn btn-outline-secondary"
                    >{{ __('common.cancelar') }}</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection