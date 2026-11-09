@extends('admin.layout')

@section('title', __('admin/users/create.nuevo_usuario'))

@section('content')
<h1 class="h3 mb-3">{{ __('admin/users/create.nuevo_usuario') }}</h1>
<div class="card shadow-sm"><div class="card-body">
    <form method="POST" action="{{ route('admin.users.store') }}">
        @include('admin.users._form')
    </form>
</div></div>
@endsection
