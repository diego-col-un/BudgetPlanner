<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  {{-- Aquí usamos la configuración de APP_NAME del .env--}}
  <title>{{ config('app.name', 'Budget Planner') }}</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

  <style>
    /* Estilo para los enlaces de la barra de navegación activa */
    .navbar-nav .nav-link {
        transition: color 0.3s ease;
        font-weight: 500;
    }
    .navbar-nav .nav-link:hover {
        color: #fff !important; /* Blanco */
    }
    /* El color de los enlaces dentro de la barra verde */
    .navbar-green .nav-link {
        color: rgba(255, 255, 255, 0.75);
    }
    .navbar-green .nav-link.active {
        color: #fff;
    }
  </style>
</head>

<body>
  <div id="app">
    {{-- BARRA DE NAVEGACIÓN con estilo consistente --}}
    <nav class="navbar navbar-expand-md navbar-dark bg-success shadow-lg navbar-green">
      <div class="container">
        {{-- Marca de la aplicación --}}
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">
          <i class="bi bi-piggy-bank me-2"></i>
          {{ config('app.name', 'Budget Planner') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav me-auto">

          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ms-auto">
            <!-- Authentication Links -->
            @guest
              @if (Route::has('login'))
                <li class="nav-item">
                  {{-- Botón de Inicio de Sesión: Outline blanco --}}
                  <a class="nav-link btn btn-outline-light px-3 me-2" href="{{ route('login') }}">
                    <i class="bi bi-box-arrow-in-right me-1"></i> {{ __('Iniciar Sesión') }}
                  </a>
                </li>
              @endif

              @if (Route::has('register'))
                <li class="nav-item">
                  {{-- Botón de Registro: Sólido verde. Mismo efecto hover pero con estilo primario. --}}
                  <a class="nav-link btn btn-outline-light px-3 me-2" href="{{ route('register') }}">
                    <i class="bi bi-person-plus me-1"></i> {{ __('Registrarse') }}
                  </a>
                </li>
              @endif
            @else
              {{-- Enlace a Categorías --}}
              <li class="nav-item">
                <a class="nav-link" href="{{ route('categories.index') }}">
                    <i class="bi bi-tags me-1"></i> Categorías
                </a> 
              </li>

              {{-- Enlace a Transacciones --}}
              <li class="nav-item">
                <a class="nav-link" href="{{ route('transactions.index') }}">
                    <i class="bi bi-currency-dollar me-1"></i> Transacciones
                </a> 
              </li>

              {{-- Enlace a Preferencias de Notificación --}}
              <li class="nav-item">
                <a class="nav-link" href="{{ route('preferences.edit') }}">
                    <i class="bi bi-bell me-1"></i> Notificaciones
                </a>  
              </li>
              
              
              {{-- Dropdown de Usuario --}}
              <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false" v-pre>
                  <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-left me-2"></i> {{ __('Cerrar Sesión') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                  </form>
                </div>
              </li>
            @endguest
          </ul>
        </div>
      </div>
    </nav>

    <main class="py-4">
      @yield('content')
    </main>
  </div>
</body>

</html>