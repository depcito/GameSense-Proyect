@extends('admin.layout')

@section('title', 'Editar usuario')

@section('content')
<h1 class="h3 mb-3">Editar usuario #{{ $user->id }}</h1>
<div class="card shadow-sm"><div class="card-body">
    <form method="POST" action="{{ route('admin.users.update', $user) }}">
        @method('PUT')
        @include('admin.users._form')
    </form>
</div></div>
@endsection
