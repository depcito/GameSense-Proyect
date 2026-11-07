<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
        rel="stylesheet"
        crossorigin="anonymous" />

    <title>@yield('title', __('Panel de administración')) - GameSense</title>
</head>

<body class="bg-light">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">

            <a class="navbar-brand" href="{{ route('admin.users.index') }}">
                GameSense · {{ __('Administración') }}
            </a>

            <!-- Hamburger button -->
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#adminNavbar"
                aria-controls="adminNavbar"
                aria-expanded="false"
                aria-label="{{ __('Abrir menú de navegación') }}">

                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navigation menu -->
            <div class="collapse navbar-collapse" id="adminNavbar">

                <div class="navbar-nav ms-auto">

                    @auth
                        @if (auth()->user()->getRole() === 'admin')

                            <a class="nav-link" href="{{ route('home.index') }}">
                                {{ __('Volver al inicio') }}
                            </a>

                            <a class="nav-link" href="{{ route('admin.users.index') }}">
                                {{ __('Administrar usuarios') }}
                            </a>

                            <a class="nav-link" href="{{ route('admin.category.create') }}">
                                {{ __('Administrar categorías') }}
                            </a>

                            <a class="nav-link" href="{{ route('admin.product.create') }}">
                                {{ __('Administrar productos') }}
                            </a>

                        @endif
                    @endauth

                    <div class="d-flex align-items-center gap-3 ms-lg-3">

                        <span class="text-white-50">
                            {{ auth()->user()->name }}
                        </span>

                        <form method="POST" action="{{ route('logout') }}" class="m-0">
                            @csrf

                            <button type="submit" class="btn btn-outline-light btn-sm">
                                {{ __('Cerrar sesión') }}
                            </button>
                        </form>

                    </div>

                </div>
            </div>

        </div>
    </nav>

    <!-- Main content -->
    <main class="container pb-5">

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')

    </main>

    <!-- Bootstrap JavaScript -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous">
    </script>

</body>

</html>
