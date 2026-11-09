@extends('admin.layout')

@section('title', __('admin/users/edit.editar_usuario'))

@section('content')
<h1 class="h3 mb-3">{{ __('admin/users/edit.title', ['id' => $user->id]) }}</h1>
<div class="card shadow-sm"><div class="card-body">
    <form method="POST" action="{{ route('admin.users.update', $user) }}">
        @method('PUT')
        @include('admin.users._form')
    </form>
</div></div>
@endsection
