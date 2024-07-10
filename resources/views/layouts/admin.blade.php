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
    <link rel='stylesheet'
        href='https://cdn-uicons.flaticon.com/2.4.2/uicons-regular-straight/css/uicons-regular-straight.css'>
    <!-- Fonts -->

    {{-- font awesome  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @yield('scripts')



    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body class="p-0">
    {{-- ||||||||||||||||||||||||||||||||  inizio header ||||||||||||||||||||||||||||||| --}}
    <header class="sticky-top ms-bg-header">
        <nav class="navbar navbar-light gap-5 d-flex align-items-center px-2">
            <div class="d-flex col-12 col-md-3 col-lg-2 mb-lg-0 flex-wrap flex-grow-1 px-3 flex-md-nowrap justify-content-between align-items-center">
                <a class="navbar-brand" href="/">
                    <img src="{{ Vite::asset('resources/img/logo-dashboard.png') }}" alt="BoolB&B" class="ms-logo">
                </a>
                <button class="navbar-toggler d-md-none collapsed border border-light" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="text-light"><i class="fa-solid fa-bars"></i></i></span>
                </button>
                <div class="collapse navbar-collapse d-md-none my-btn-navbar" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link text-white px-1 ms-myhover" href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-house"></i> Dashboard utente</a>
                        <a class="nav-link text-white px-1 ms-myhover" href="{{ route('admin.apartments.index') }}"><i class="fa-solid fa-building"></i> I miei appartamenti</a>
                        <a class="nav-link text-white px-1 ms-myhover" href="{{ route('admin.apartments.create') }}"><i class="fa-solid fa-plus"></i> Inserisci appartamento</a>
                        <a class="nav-link text-white px-1 ms-myhover" href="{{ route('admin.messages') }}"><i class="fa-regular fa-comment"></i> Messaggi ricevuti <span class="badge bg-info">{{ $messageCount }}</span></a>
                        <a class="nav-link text-white px-1 ms-myhover" href="{{ route('admin.garbage') }}"><i class="fa-solid fa-trash"></i> Cestino</a>
                        <a class="dropdown-item nav-link text-white px-1 ms-myhover" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><i
                                class="fa-solid fa-arrow-right-from-bracket text-white"></i>
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>

                        {{-- logout display lg  --}}
                        <div class="d-none d-md-flex  col-12 col-md-5 col-lg-1 d-flex align-items-center justify-content-md-end mt-3 mt-md-0">
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
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-2 d-none d-xl-flex gap-2">
                <a href="{{ route('admin.garbage') }}"
                    class="text-primary p-2 rounded-pill d-flex align-items-center justify-content-center text-decoration-none my-btn-nav" style="height: 40px">
                    <i class="fa-solid fa-trash fs-4"></i>
                </a>
                <a href="{{ route('admin.messages') }}"
                    class="text-primary p-2 rounded-pill d-flex align-items-center justify-content-center text-decoration-none my-btn-nav" style="height: 40px">
                    <i class="fa-regular fa-message fs-4"></i>
                </a>
            </div>

            <div
                class="d-none d-md-flex  col-12 col-md-5 col-lg-1 d-flex align-items-center justify-content-md-end mt-3 mt-md-0">
                <div class="btn-group">
                    <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Ciao, <strong>{{ Auth::user()->name }}</strong>
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
    {{-- |||||||||||||||||||||||||||||||  fine header |||||||||||||||||||||||||||||| --}}

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
                            <a class="nav-link {{ Route::currentRouteName() == 'admin.apartments.index' || Route::currentRouteName() == 'admin.apartments.show' || Route::currentRouteName() == 'admin.payment' ? 'bg-body-secondary text-dark border-start border-primary border-4 rounded' : '' }}"
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
                        <li class="nav-item p-2">
                            <a class="nav-link {{ Route::currentRouteName() == 'admin.messages' ? 'bg-body-secondary text-dark border-start border-primary border-4 rounded' : '' }}"
                                href="{{ route('admin.messages') }}">
                                <i class="fa-regular fa-comment"></i>
                                <small>Messaggi Ricevuti</small>
                                <span class="badge bg-primary">{{ $messageCount}}</span>
                            </a>
                        </li>
                        <li class="nav-item p-2">
                            <a class="nav-link {{ Route::currentRouteName() == 'admin.garbage' ? 'bg-body-secondary text-dark border-start border-primary border-4 rounded' : '' }}"
                                href="{{ route('admin.garbage') }}">
                                <i class="fa-solid fa-trash"></i>
                                <small>Cestino</small>
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
                            <li class="breadcrumb-item" disabled><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        </ol>
                    </nav>

                    @yield('content')
                </div>

                <footer class="row-container pt-5 d-flex justify-content-between">
                    <div class="col-6">
                        <span>Copyright ©2024-2025 <a href="/">BoolB&B</a></span>
                    </div>
                    <div class="col-6">
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
                    </div>
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
        background-color: #0D6EFD;
    }
    
    .ms-myhover:hover {
        background-color: #057eff;
        color: white;
        border-radius: 10px; 
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

    .my-btn-nav {
        width: 40px;
        height: 40px;
        background-color: white;
        border: 1px solid white;
    }

    .my-btn-nav:hover {
        background: #0d81fd;
        color: white;
        border: 1px solid white;
        transition: 0.3s;
    }

    .my-btn-nav:hover.my-btn-nav>i {
        color: white;
    }

    .sidebar .nav-link {
        color: #7d7979;
    }

    .sidebar .nav-link.active {
        color: #0d6efd;
    }

    .my-btn-navbar {
        transition: 0.6s;
    }
</style>
