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

    <style>
        body {
            min-height: 100vh;
        }

        .admin-sidebar {
            min-height: 100vh;
            background-color: #212529;
            padding: 25px 15px;
        }

        .admin-sidebar .nav-link {
            color: #adb5bd;
            padding: 12px 15px;
            border-radius: 5px;
            margin-bottom: 5px;
        }

        .admin-sidebar .nav-link:hover,
        .admin-sidebar .nav-link.active {
            background-color: #343a40;
            color: #ffffff;
        }

        .admin-content {
            padding: 30px;
        }

        .admin-brand {
            color: #ffffff;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 35px;
        }

        .sidebar-section {
            color: #6c757d;
            font-size: 12px;
            text-transform: uppercase;
            margin: 20px 15px 10px;
        }
    </style>
</head>

<body class="bg-light">

    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            <aside class="col-md-3 col-lg-2 admin-sidebar">

                <div class="admin-brand">
                    GameSense
                    <small class="d-block text-white-50 fs-6">
                        Administración
                    </small>
                </div>

                @auth
                    @if (auth()->user()->getRole() === 'admin')

                        <p class="sidebar-section">Principal</p>

                        <nav class="nav flex-column">

                            <a
                                href="{{ route('home.index') }}"
                                class="nav-link">
                                Volver a la tienda
                            </a>

                        </nav>

                        <p class="sidebar-section">Gestión</p>

                        <nav class="nav flex-column">

                            <a
                                href="{{ route('admin.users.index') }}"
                                class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                                Administrar usuarios
                            </a>

                            <a
                                href="{{ route('admin.category.index') }}"
                                class="nav-link {{ request()->routeIs('admin.category.*') ? 'active' : '' }}">
                                Administrar categorías
                            </a>

                            <a
                                href="{{ route('admin.product.index') }}"
                                class="nav-link {{ request()->routeIs('admin.product.*') ? 'active' : '' }}">
                                Administrar productos
                            </a>

                            <a
                                href="{{ route('admin.order.index') }}"
                                class="nav-link {{ request()->routeIs('admin.order.*') ? 'active' : '' }}">
                                Administrar pedidos
                            </a>

                            <a
                                href="{{ route('admin.payment.index') }}"
                                class="nav-link {{ request()->routeIs('admin.payment.*') ? 'active' : '' }}">
                                Administrar pagos
                            </a>

                            <a
                                href="{{ route('admin.review.index') }}"
                                class="nav-link {{ request()->routeIs('admin.review.*') ? 'active' : '' }}">
                                Administrar reseñas
                            </a>

                        </nav>

                    @endif
                @endauth

                <div class="mt-5 pt-3 border-top border-secondary">

                    <p class="text-white-50 small mb-2">
                        {{ auth()->user()->name }}
                    </p>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit" class="btn btn-outline-light btn-sm w-100">
                            Cerrar sesión
                        </button>
                    </form>

                </div>

            </aside>

            <!-- Main content -->
            <main class="col-md-9 col-lg-10 admin-content">

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

        </div>
    </div>

    <!-- Bootstrap JavaScript -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous">
    </script>

</body>

</html>
