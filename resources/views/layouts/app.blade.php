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
                aria-label="Abrir menú de navegación">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">

                    <a class="nav-link" href="{{ route('home.index') }}">
                        Inicio
                    </a>

                    <a class="nav-link" href="{{ route('category.index') }}">
                        Categorías
                    </a>

                    <a class="nav-link" href="{{ route('product.index') }}">
                        Productos
                    </a>

                    <a class="nav-link" href="#">
                        Contáctanos
                    </a>
                    <div class="vr bg-white mx-2 d-none d-lg-block"></div>
                    @auth
                    <a class="nav-link" href="{{ route('payment.index') }}"> Pagos </a>
                    @if (auth()->user()->role === 'admin')
                        <a class="nav-link" href="{{ route('category.create') }}"> Administrar categorias </a>
                        <a class="nav-link" href="{{ route('product.create') }}"> Administrar productos </a>
                    @endif
                    @endauth
                    @guest
                    <a class="nav-link" href="{{ route('login') }}">
                        Iniciar sesión
                    </a>

                    <a class="nav-link" href="{{ route('register') }}">
                        Registrarse
                    </a>
                    @else
                    <form id="logout" action="{{ route('logout') }}" method="POST">
                        @csrf
                        
                        <button type="submit" class="nav-link border-0 bg-transparent">
                            Cerrar sesión
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
            <p class="mb-0">&copy; {{ date('Y') }} Los mejores en esto.</p>
        </div>
    </footer>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>

</body>

</html>