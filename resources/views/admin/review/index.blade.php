@extends('admin.layout')

@section('title', __('admin/review/index.administrar_resenas'))

@section('content')

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>{{ __('admin/review/index.administrar_resenas') }}</h2>
    </div>

    <form method="GET" action="{{ route('admin.review.index') }}" class="row g-2 mb-3">
        <div class="col-sm-8 col-md-6">
            <input type="text" name="search" value="{{ $viewData['search'] }}" class="form-control"
                placeholder="{{ __('admin/review/index.buscar_por_comentario_producto') }}">
        </div>
        <div class="col-auto">
            <button class="btn btn-secondary" type="submit">{{ __('common.buscar') }}</button>
            @if ($viewData['search'] !== '')
                <a href="{{ route('admin.review.index') }}" class="btn btn-link">{{ __('common.limpiar') }}</a>
            @endif
        </div>
    </form>

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle">

                    <thead>
                        <tr>
                            <th>{{ __('common.id') }}</th>
                            <th>{{ __('common.producto') }}</th>
                            <th>{{ __('common.usuario') }}</th>
                            <th>{{ __('admin/review/index.calificacion') }}</th>
                            <th>{{ __('admin/review/index.comentario') }}</th>
                            <th>{{ __('common.fecha') }}</th>
                            <th>{{ __('common.acciones') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($viewData['reviews'] as $review)
                            <tr>
                                <td>{{ $review->getId() }}</td>
                                <td>{{ $review->getProduct()?->getTitle() ?? __('common.product_deleted') }}</td>
                                <td>{{ $review->getUser()?->getName() ?? __('common.user_deleted') }}</td>
                                <td>{{ $review->getRating() }}/5</td>
                                <td>{{ \Illuminate\Support\Str::limit($review->getComment(), 60) }}</td>
                                <td>{{ $review->getDate()->format('d/m/Y') }}</td>

                                <td>
                                    <div class="d-flex gap-2">

                                        <a href="{{ route('review.show', ['id' => $review->getId()]) }}"
                                            class="btn btn-info btn-sm">
                                            {{ __('common.ver') }}
                                        </a>

                                        <form action="{{ route('admin.review.destroy', ['id' => $review->getId()]) }}"
                                            method="POST"
                                            onsubmit="return confirm(@js(__('admin/review/index.confirm_delete')))">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm">
                                                {{ __('common.eliminar') }}
                                            </button>

                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    {{ __('admin/review/index.no_hay_resenas_registradas') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            {{ $viewData['reviews']->links() }}

        </div>
    </div>

</div>

@endsection
