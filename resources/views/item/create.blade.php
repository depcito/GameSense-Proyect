@extends('layouts.app')

@section('title', $viewData['title'])

@section('subtitle', 'Pedido #' . $viewData['order']->getId())

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h4 class="mb-4">Agregar producto al pedido #{{ $viewData['order']->getId() }}</h4>

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
                        <label for="product_id" class="form-label">Producto</label>
                        <select name="product_id" id="product_id" class="form-select" required>
                            <option value="">Selecciona un producto</option>
                            @foreach ($viewData['products'] as $product)
                                <option
                                    value="{{ $product->getId() }}"
                                    @selected(old('product_id', $viewData['selectedProductId']) == $product->getId())
                                >
                                    {{ $product->getTitle() }} — ${{ number_format($product->getPrice(), 0, ',', '.') }} COP
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="quantity" class="form-label">Cantidad</label>
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

                    <button type="submit" class="btn btn-primary">Agregar</button>
                    <a
                        href="{{ route('item.index', ['order_id' => $viewData['order']->getId()]) }}"
                        class="btn btn-outline-secondary"
                    >
                        Cancelar
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection