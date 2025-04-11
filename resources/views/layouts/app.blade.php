<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ControlStock') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Estilos para o modo claro */
        body {
            transition: background-color 0.3s ease, color 0.3s ease;
            background-color: #ffffff;
            color: #000000;
        }

        /* Estilos para o modo escuro - base */
        body.dark-mode {
            background-color: #181818;
            color: #e0e0e0;
        }

        /* Navbar */
        .dark-mode .navbar {
            background-color: #222 !important;
            border-bottom: 1px solid #333;
        }

        .dark-mode .navbar-brand,
        .dark-mode .nav-link,
        .dark-mode .navbar-light .navbar-nav .nav-link {
            color: #e0e0e0 !important;
        }

        .dark-mode .navbar-toggler-icon {
            filter: invert(1);
        }

        /* Cards e containers */
        .dark-mode .card,
        .dark-mode .container .row > div > div,
        .dark-mode form {
            background-color: #242424 !important;
            color: #e0e0e0 !important;
            border-color: #444 !important;
        }

        /* Tabelas */
        .dark-mode .table {
            background-color: #242424;
            color: #e0e0e0;
            border: 1px solid #444;
        }

        .dark-mode .table th {
            background-color: #333;
            color: #ffffff;
            border-color: #444 !important;
        }

        .dark-mode .table td {
            border-color: #444 !important;
        }

        .dark-mode .table tr {
            background-color: #2a2a2a;
        }

        .dark-mode .table tr:hover {
            background-color: #3a3a3a;
        }

        /* Botões */
        .dark-mode .btn-primary {
            background-color: #5c6bc0;
            border-color: #3f51b5;
        }

        .dark-mode .btn-secondary {
            background-color: #444;
            color: #ffffff;
            border: 1px solid #666;
        }

        .dark-mode .btn-warning {
            background-color: #f0ad4e;
            border-color: #eea236;
            color: #212529;
        }

        .dark-mode .btn-danger {
            background-color: #d9534f;
            border-color: #d43f3a;
        }

        .dark-mode .btn:hover {
            filter: brightness(1.1);
        }

        /* Links */
        .dark-mode a {
            color: #bb86fc;
        }

        .dark-mode a:hover {
            color: #e0e0e0;
        }

        /* Container */
        .dark-mode .container {
            background-color: transparent; /* Alterado para transparente para evitar conflitos */
            border-radius: 8px;
            padding: 20px;
        }

        /* Form controls */
        .dark-mode input, 
        .dark-mode textarea, 
        .dark-mode select,
        .dark-mode .form-control {
            background-color: #333 !important;
            color: #ffffff !important;
            border: 1px solid #666 !important;
        }

        .dark-mode input::placeholder,
        .dark-mode .form-control::placeholder {
            color: #aaa !important;
        }

        /* Card headers */
        .dark-mode .card-header {
            background-color: #2c2c2c !important;
            border-bottom: 1px solid #444 !important;
        }

        /* Dropdown menus */
        .dark-mode .dropdown-menu {
            background-color: #333 !important;
            border: 1px solid #444 !important;
        }

        .dark-mode .dropdown-item {
            color: #e0e0e0 !important;
        }

        .dark-mode .dropdown-item:hover {
            background-color: #444 !important;
        }

        /* Paginação */
        .dark-mode .pagination {
            background-color: transparent;
        }

        .dark-mode .pagination .page-item .page-link {
            background-color: #333;
            border-color: #444;
            color: #e0e0e0;
        }

        .dark-mode .pagination .page-item.active .page-link {
            background-color: #5c6bc0;
            border-color: #3f51b5;
            color: #fff;
        }

        .dark-mode .pagination .page-item.disabled .page-link {
            background-color: #2a2a2a;
            border-color: #444;
            color: #666;
        }

        /* Fix para elementos específicos */
        .dark-mode h1, .dark-mode h2, .dark-mode h3, .dark-mode h4, .dark-mode h5, .dark-mode h6 {
            color: #e0e0e0;
        }

        /* SweetAlert2 customization */
        .swal2-dark {
            background-color: #333 !important;
            color: #fff !important;
        }

        .swal2-dark .swal2-title,
        .swal2-dark .swal2-content {
            color: #fff !important;
        }

        /* Fix for pagination container */
        .pagination-container {
            margin-top: 20px;
        }
        
        /* IMPORTANTE: Removidos os estilos que afetavam layout */
        
        /* Toggle de modo escuro - adicionar estilos consistentes */
        .theme-toggle {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            border-radius: 12px;
            background: #f3f4f6;
            color: #4b5563;
            font-weight: 500;
            gap: 0.5rem;
            transition: background-color 0.3s ease, color 0.3s ease;
            border: none;
            cursor: pointer;
        }

        body.dark-mode .theme-toggle {
            background: #374151;
            color: #e5e7eb;
        }

        .theme-toggle:hover {
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'ControlStock') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        $(document).ready(function() {
            // Verifica se o modo escuro está ativado no localStorage
            if (localStorage.getItem('dark-mode') === 'enabled') {
                $('body').addClass('dark-mode');
                
                // Verifica se o SweetAlert está presente e aplica o tema escuro
                if (typeof Swal !== 'undefined') {
                    Swal.getContainer()?.classList.add('swal2-dark');
                }
            }

            // Não adiciona manipulador de eventos aqui - será adicionado na página específica
        });
    </script>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</html>