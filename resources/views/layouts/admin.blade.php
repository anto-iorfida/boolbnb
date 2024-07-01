<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Fonts -->

    {{-- font awesome  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @yield('scripts')



    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    {{-- |||||||||||||||||||||||||||||||  inizio header ||||||||||||||||||||||||||||||| --}}
    <header class="sticky-top ms-bg-header">
        <nav class="navbar navbar-light p-3">
            <div class="d-flex col-12 col-md-3 col-lg-2 mb-2 mb-lg-0 flex-wrap flex-md-nowrap justify-content-between">
                <a class="navbar-brand" href="/">
                    <img src="{{ Vite::asset('resources/img/logo-dashboard.png') }}" alt="BoolB&B" class="ms-logo">
                </a>
                <button class="navbar-toggler d-md-none collapsed mb-3" type="button" data-toggle="collapse"
                    data-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <div class="col-12 col-md-5 col-lg-8 d-flex align-items-center justify-content-md-end mt-3 mt-md-0">
                <div class="btn-group">
                    <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Ciao, {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i
                                    class="fa-solid fa-arrow-right-from-bracket"></i>
                                {{ __('Logout') }}
                            </a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    {{-- |||||||||||||||||||||||||||||||  fini header |||||||||||||||||||||||||||||| --}}

    <div class="container-fluid">
        <div class="row">
            {{-- |||||||||||||||||||||||||||||||  inizio sidebar ||||||||||||||||||||||||||||||| --}}
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item p-2">
                            <a class="nav-link {{ Route::currentRouteName() == 'admin.dashboard' ? 'bg-body-secondary text-dark border-start border-primary border-4 rounded' : '' }}"
                                href="{{ route('admin.dashboard') }}">
                                <i class="fa-solid fa-house"></i>
                                <small>Dashboard utente</small>
                            </a>
                        </li>
                        <li class="nav-item p-2">
                            <a class="nav-link {{ Route::currentRouteName() == 'admin.apartments.index'  ? 'bg-body-secondary text-dark border-start border-primary border-4 rounded' : '' }}"
                                href="{{ route('admin.apartments.index') }}">
                                <i class="fa-solid fa-building"></i>
                                <small>I miei appartamenti</small>
                            </a>
                        </li>
                        <li class="nav-item p-2">
                            <a class="nav-link {{ Route::currentRouteName() == 'admin.apartments.create' ? 'bg-body-secondary text-dark border-start border-primary border-4 rounded' : '' }}"
                                href="{{ route('admin.apartments.create') }}">
                                <i class="fa-solid fa-plus"></i>
                                <small>Inserisci appartamento</small>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            {{-- |||||||||||||||||||||||||||||||  fine sidebar ||||||||||||||||||||||||||||||| --}}

            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4 bg-white">
                <div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Overview</li>
                        </ol>
                    </nav>

                    @yield('content')
                </div>

                <footer class="pt-5 d-flex justify-content-between">
                    <span>Copyright © 2024-2025 <a href="/">BoolB&B</a></span>
                    <ul class="nav m-0">
                        <li class="nav-item">
                            <a class="nav-link text-secondary" aria-current="page" href="#">Privacy Policy</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-secondary" href="#">Termini e condizioni</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-secondary" href="#">Contatti</a>
                        </li>
                    </ul>
                </footer>
            </main>

        </div>
    </div>
</body>

</html>


<style>
    /* width */
    body::-webkit-scrollbar {
        width: 10px;
    }

    /* Track */
    body::-webkit-scrollbar-track {
        background-color: #gray;
    }

    /* Handle */
    body::-webkit-scrollbar-thumb {
        background-color: gray;
        border-radius: 6px;
    }

    body::-webkit-scrollbar-thumb:hover {
        background-color: #0D6EFD;
    }

    .ms-bg-header {
        background-color: #0d6efd;
    }

    main {
        height: 100%;

    }

    .sidebar {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        z-index: 100;
        padding: 90px 0 0;
        box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
        z-index: 99;
    }

    @media (max-width: 767.98px) {
        .sidebar {
            top: 11.5rem;
            padding: 0;
        }
    }

    .navbar {
        box-shadow: inset 0 -1px 0 rgba(0, 0, 0, .1);
    }

    @media (min-width: 767.98px) {
        .navbar {
            top: 0;
            position: sticky;
            z-index: 999;
        }
    }

    .sidebar .nav-link {
        color: #7d7979;
    }

    .sidebar .nav-link.active {
        color: #0d6efd;
    }
</style>
