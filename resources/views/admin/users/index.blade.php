@extends('admin.layout')

@section('title', 'Usuarios')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 m-0">Usuarios</h1>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Nuevo usuario</a>
</div>

<form method="GET" action="{{ route('admin.users.index') }}" class="row g-2 mb-3">
    <div class="col-sm-8 col-md-6">
        <input type="text" name="search" value="{{ $search }}" class="form-control" placeholder="Buscar por nombre o correo">
    </div>
    <div class="col-auto">
        <button class="btn btn-secondary" type="submit">Buscar</button>
        @if ($search !== '')
            <a href="{{ route('admin.users.index') }}" class="btn btn-link">Limpiar</a>
        @endif
    </div>
</form>

<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle m-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Dirección</th>
                    <th>Rol</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->address }}</td>
                        <td>
                            <span class="badge {{ $user->role === 'admin' ? 'bg-danger' : 'bg-secondary' }}">{{ $user->role }}</span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="d-inline"
                                  onsubmit="return confirm('¿Eliminar este usuario?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center text-muted py-4">No hay usuarios.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">{{ $users->links('pagination::bootstrap-5') }}</div>
@endsection
