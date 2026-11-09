@extends('layouts.app')

@section('title', $viewData['title'])

@section('subtitle', __('common.order_number', ['id' => $viewData['order']->getId()]))

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h4 class="mb-4">{{ __('item/create.heading', ['id' => $viewData['order']->getId()]) }}</h4>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('item.save') }}">
                    @csrf

                    <input type="hidden" name="order_id" value="{{ $viewData['order']->getId() }}">

                    <div class="mb-3">
                        <label for="product_id" class="form-label">{{ __('common.producto') }}</label>
                        <select name="product_id" id="product_id" class="form-select" required>
                            <option value="">{{ __('item/create.selecciona_un_producto') }}</option>
                            @foreach ($viewData['products'] as $product)
                                <option
                                    value="{{ $product->getId() }}"
                                    @selected(old('product_id', $viewData['selectedProductId']) == $product->getId())
                                >
                                    {{ $product->getTitle() }} — {{ __('common.money', ['amount' => number_format($product->getPrice(), 0, ',', '.')]) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="quantity" class="form-label">{{ __('common.cantidad') }}</label>
                        <input
                            type="number"
                            name="quantity"
                            id="quantity"
                            min="1"
                            value="{{ old('quantity', 1) }}"
                            class="form-control"
                            required
                        >
                    </div>

                    <button type="submit" class="btn btn-primary">{{ __('item/create.agregar') }}</button>
                    <a
                        href="{{ route('item.index', ['order_id' => $viewData['order']->getId()]) }}"
                        class="btn btn-outline-secondary"
                    >
                        {{ __('common.cancelar') }}
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection