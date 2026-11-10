@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-2">{{ __('Contact us') }}</h1>
    <p class="text-secondary mb-4">{{ __('Have a question? Reach out to us.') }}</p>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ __('Email') }}</h5>
                    <a href="mailto:{{ config('ecommerce.contact.email') }}">
                        {{ config('ecommerce.contact.email') }}
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ __('Phone') }}</h5>
                    <a href="tel:{{ preg_replace('/\s+/', '', config('ecommerce.contact.phone')) }}">
                        {{ config('ecommerce.contact.phone') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection