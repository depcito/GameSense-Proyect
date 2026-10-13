@csrf

<div class="mb-3">
    <label for="name" class="form-label">Nombre</label>
    <input type="text" id="name" name="name" value="{{ old('name', $user->name ?? '') }}"
           class="form-control @error('name') is-invalid @enderror" required>
    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label for="email" class="form-label">Correo</label>
    <input type="email" id="email" name="email" value="{{ old('email', $user->email ?? '') }}"
           class="form-control @error('email') is-invalid @enderror" required>
    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label for="address" class="form-label">Dirección</label>
    <input type="text" id="address" name="address" value="{{ old('address', $user->address ?? '') }}"
           class="form-control @error('address') is-invalid @enderror">
    @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label for="role" class="form-label">Rol</label>
    <select id="role" name="role" class="form-select @error('role') is-invalid @enderror" required>
        @foreach ($roles as $role)
            <option value="{{ $role }}" @selected(old('role', $user->role ?? 'user') === $role)>{{ $role }}</option>
        @endforeach
    </select>
    @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

@php($isEdit = isset($user))

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="password" class="form-label">
            Contraseña
            @if ($isEdit)<small class="text-muted">(vacía para no cambiarla)</small>@endif
        </label>
        <input type="password" id="password" name="password" autocomplete="new-password"
               class="form-control @error('password') is-invalid @enderror" @required(! $isEdit)>
        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6 mb-3">
        <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
        <input type="password" id="password_confirmation" name="password_confirmation"
               autocomplete="new-password" class="form-control" @required(! $isEdit)>
    </div>
</div>

<button type="submit" class="btn btn-primary">Guardar</button>
<a href="{{ route('admin.users.index') }}" class="btn btn-link">Cancelar</a>
