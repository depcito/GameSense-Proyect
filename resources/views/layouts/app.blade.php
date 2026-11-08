<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
        rel="stylesheet"
        crossorigin="anonymous" />

    <link href="{{ asset('/css/app.css') }}" rel="stylesheet" />

    <title>@yield('title', 'GameSense')</title>
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary py-4">
        <div class="container">

            <a class="navbar-brand" href="{{ route('home.index') }}">
                GameSense
            </a>

            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup"
                aria-expanded="false"
                aria-label="{{ __('Abrir menú de navegación') }}">

                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">

                    <a class="nav-link" href="{{ route('home.index') }}">
                        {{ __('Inicio') }}
                    </a>

                    <a class="nav-link" href="{{ route('category.index') }}">
                        {{ __('Categorías') }}
                    </a>

                    <a class="nav-link" href="{{ route('product.index') }}">
                        {{ __('Productos') }}
                    </a>

                    <a class="nav-link" href="#">
                        {{ __('Contáctanos') }}
                    </a>

                    <div class="vr bg-white mx-2 d-none d-lg-block"></div>

                    @guest

                        <a class="nav-link" href="{{ route('login') }}">
                            {{ __('Iniciar sesión') }}
                        </a>

                        <a class="nav-link" href="{{ route('register') }}">
                            {{ __('Registrarse') }}
                        </a>

                    @else

                        <a class="nav-link" href="{{ route('cart.index') }}">
                            {{ __('Carrito') }}
                        </a>

                        <a class="nav-link" href="{{ route('order.index') }}">
                            {{ __('Pedidos') }}
                        </a>

                        <a class="nav-link" href="{{ route('payment.index') }}">
                            {{ __('Pagos') }}
                        </a>

                        @if (auth()->user()->getRole() === 'admin')
                            <a class="nav-link" href="{{ route('admin.users.index') }}">
                                {{ __('Panel de administración') }}
                            </a>
                        @endif

                        <form id="logout" action="{{ route('logout') }}" method="POST">
                            @csrf

                            <button type="submit" class="nav-link border-0 bg-transparent">
                                {{ __('Cerrar sesión') }}
                            </button>
                        </form>

                    @endguest

                </div>
            </div>

        </div>
    </nav>

    <!-- Header banner -->
    <header class="masthead bg-secondary text-white text-center py-4">
    </header>

    <!-- Main content -->
    <main class="container my-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="copyright py-4 text-center text-white">
        <div class="container">
            <p class="mb-0">
                &copy; {{ date('Y') }} {{ __('Los mejores en esto.') }}
            </p>
        </div>
    </footer>

    <!-- Bootstrap JavaScript -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous">
    </script>

</body>

</html>
