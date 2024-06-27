<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fontawesome 6 cdn -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css' integrity='sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==' crossorigin='anonymous' referrerpolicy='no-referrer' />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    @yield('scripts')
    


    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body class="overflow-hidden">
    <div id="app">

        <header class="navbar sticky-top ms-bg-primary flex-md-nowrap shadow px-2">
            <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 text-center" href="/">
                <img class="ms-logo" src="{{ Vite::asset('resources/img/logo-dashboard.png') }}">
            </a>
            <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            {{-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> --}}
            <div class="navbar-nav">
                <div class="nav-item text-nowrap ms-2">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </header>

        <div class="container-fluid vh-100">
            <div class="row h-100">
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-primary navbar-dark sidebar collapse vh-100">
                    <div class="position-sticky pt-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link rounded {{ Route::currentRouteName() == 'admin.dashboard' ? 'bg-light text-dark' : '' }}" href="{{ route('admin.dashboard')}}">
                                    <i class="fa-solid fa-gauge-high"></i> Dashboard Utente
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link rounded {{ Route::currentRouteName() == 'admin.apartments.index' ? 'bg-light text-dark' : '' }}" href="{{ route('admin.apartments.index')}}">
                                    <i class="fa-regular fa-rectangle-list"></i> I tuoi appartamenti
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link rounded {{ Route::currentRouteName() == 'admin.apartments.create' ? 'bg-light text-dark' : '' }}" href="{{ route('admin.apartments.create')}}">
                                    <i class="fa-solid fa-plus"></i> Inserisci un appartamento
                                </a>
                            </li>
                            
                        </ul>


                    </div>
                </nav>

                <main class="col-md-9 ms-sm-auto col-lg-10 p-0 vh-100 overflow-auto">
                    @yield('content')
                </main>
            </div>
        </div>

    </div>
</body>

</html>
<style>

    .ms-bg-primary {
        background-color: white;
    }
    .nav .nav-item a{
        color: white;
    }

 .nav .nav-item:hover{
    background: white;
    border-radius: 5px;
    }
    .nav .nav-item:hover a{
        color: black;
        font-size: 18px;
        transition: 0.8s;
    }
</style>