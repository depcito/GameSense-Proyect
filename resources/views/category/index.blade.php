@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')

<div class="row">

    @foreach ($viewData['categories'] as $category)

    <div class="col-md-4 col-lg-3 mb-4">

        <a href="{{ route('category.show', ['id' => $category->getId()]) }}"
            class="text-decoration-none text-reset">

            <div class="card category-card h-100 border-0 shadow-sm">

                <div class="category-cover d-flex align-items-center justify-content-center">
                    <h3 class="category-name text-center">
                        {{ $category->getName() }}
                    </h3>
                </div>

                <div class="card-body text-center">
                    <p class="card-text text-muted mb-0">
                        {{ $category->getDescription() }}
                    </p>
                </div>

            </div>

        </a>

    </div>

    @endforeach

</div>

@endsection