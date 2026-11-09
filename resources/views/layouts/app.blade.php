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
                {{ __('layouts/app.gamesense') }}
            </a>

            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup"
                aria-expanded="false"
                aria-label="{{ __('layouts/app.abrir_menu_de_navegacion') }}">

                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">

                    <a class="nav-link" href="{{ route('home.index') }}">
                        {{ __('layouts/app.inicio') }}
                    </a>

                    <a class="nav-link" href="{{ route('category.index') }}">
                        {{ __('layouts/app.categorias') }}
                    </a>

                    <a class="nav-link" href="{{ route('product.index') }}">
                        {{ __('common.productos') }}
                    </a>

                    <a class="nav-link" href="#">
                        {{ __('layouts/app.contactanos') }}
                    </a>

                    <div class="vr bg-white mx-2 d-none d-lg-block"></div>

                    @guest

                        <a class="nav-link" href="{{ route('login') }}">
                            {{ __('layouts/app.iniciar_sesion') }}
                        </a>

                        <a class="nav-link" href="{{ route('register') }}">
                            {{ __('layouts/app.registrarse') }}
                        </a>

                    @else

                        <a class="nav-link" href="{{ route('cart.index') }}">
                            {{ __('layouts/app.carrito') }}
                        </a>

                        <a class="nav-link" href="{{ route('order.index') }}">
                            {{ __('layouts/app.pedidos') }}
                        </a>

                        @if (auth()->user()->getRole() === 'admin')
                            <a class="nav-link" href="{{ route('admin.users.index') }}">
                                {{ __('layouts/app.panel_de_administracion') }}
                            </a>
                        @endif

                        <form id="logout" action="{{ route('logout') }}" method="POST">
                            @csrf

                            <button type="submit" class="nav-link border-0 bg-transparent">
                                {{ __('layouts/app.cerrar_sesion') }}
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
                &copy; {{ date('Y') }} {{ __('layouts/app.los_mejores_en_esto') }}
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
