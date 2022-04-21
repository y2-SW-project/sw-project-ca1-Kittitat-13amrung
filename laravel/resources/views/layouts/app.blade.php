<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body class="">
    <div id="app text-colour">
        <div class="offcanvas bg-dark offcanvas-end" data-bs-scroll="true" data-bs-backdrop="true" tabindex="-1" id="menu"
            aria-labelledby="menuLabel">
            <div class="offcanvas-header">
                <div class="offcanvas-title" id="offcanvasScrollingLabel">
                    @auth
                    <div class="username">
                            <div class="row my-5">
                                <div class="col-lg-12 d-flex">
                                    <div class="col-lg-5">
                                        @if (Auth::user()->image)
                                            <img class="img-fluid rounded-circle"
                                                src="{{ asset('/storage/profile/' . Auth::user()->image) }}"
                                                alt="profile_image">
                                        @else
                                        <img class="img-fluid w-100 align-self-center mx-3"
                                        src="{{ asset('/storage/image/person-circle.svg') }}" alt="profile_image">
                                        @endif
                                    </div>

                                    <div class="mt-3 col-lg-6 ms-auto">

                                        <h2 class="d-block text-center username">
                                            {{ Auth::user()->name }}
                                        </h2>
                                        <div class="d-block navbar-item dropdown text-center">
                                            <a class="nav-link dropdown-toggle" id="statusDropdown" href="#" role="button"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                <span class="text-dark">
                                                    <i class="text-success fs-6 bi bi-circle-fill"></i>
                                                    available
                                                </span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-dark dropdown-menu-start"
                                                aria-labelledby="statusDropdown">
                                                <a class="dropdown-item" href="#">
                                                    <i class="text-danger fs-6 bi bi-circle-fill"></i>
                                                    busy
                                                </a>
                                                <a class="dropdown-item" href="#">
                                                    <i class="text-secondary fs-6 bi bi-circle"></i>
                                                    away
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    @endauth
                </div>
                <!-- <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button> -->
            </div>
            <div class="border-0 border-primary border-bottom border-top fs-2">
                <ul class="navbar-nav">

                    <li class="nav-menu navbar-item py-4">
                        <a href="{{ route('arts.requests') }}" class="nav-link nav-size">
                            <i class="mx-5 bi bi-compass"></i>
                            {{ __('Explore') }}
                        </a>
                    </li>

                    <li class="nav-menu navbar-item py-4">
                        <a href="{{ url('/') }}" class="nav-link nav-size">
                            <i class="mx-5 bi bi-heart"></i>
                            {{ __('Favourites') }}
                        </a>
                    </li>

                    <li class="nav-menu navbar-item py-4">
                        <a href="{{ route('user.profile') }}" class="nav-link nav-size">
                            <i class="mx-5 bi bi-person-badge-fill"></i>
                            {{ __('Profile') }}
                        </a>
                    </li>
                    <li class="nav-menu navbar-item py-4">
                        <a href="{{ url('/') }}" class="nav-link nav-size">
                            <i class="mx-5 bi bi-chat-square-fill"></i>
                            {{ __('Messages') }}
                        </a>
                    </li>


                    <li class="nav-menu navbar-item py-4">
                        <a href="{{ url('/') }}" class="nav-link nav-size">
                            <i class="mx-5 bi bi-gear-fill"></i>
                            {{ __('Settings') }}
                        </a>
                    </li>

                    <li class="nav-menu navbar-item py-4">
                        <a class="nav-link nav-size" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                            <i class="mx-5 bi bi-box-arrow-right"></i>
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="login modal" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                <div class="modal-content bg-primary">
                    <div class="modal-header">
                        <span></span>
                        <h6 class="modal-title fs-4" id="login">
                            <i class="fs-2 bi bi-person-circle pe-2 "></i>
                            {{ __('Login') }}
                        </h6>
                        <a href="#" class="fs-4 nav-link text-dark">
                            <span data-bs-dismiss="modal" aria-hidden="true">&times;</span>
                        </a>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf


                            <div class="row justify-content-center mb-3">
                                <label for="email"
                                    class="col-md-8 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-8">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row justify-content-center mb-3">
                                <label for="password"
                                    class="col-md-8 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-8">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-12 offset-md-2">
                                    <button type="submit" class="btn btn-dark col-md-8">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('register'))
                                        <ul class="navbar-nav">
                                            <li class="nav-item">
                                                <a class="nav-link text-secondary offset-md-2" href="{{ route('register') }}">
                                                    {{ __('Not sign up yet? Sign Up') }}</a>
                                            </li>
                                        </ul>
                                    @endif
                                    <!-- @if (Route::has('password.request'))
<a class="btn btn-link offset-md-2" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
@endif -->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="nav-header fixed-top navbar navbar-expand-md navbar-light " style="backdrop-filter: blur(1px);">
        <div class="container">
            <a class="logo-brand d-flex" href="{{ url('/') }}">
                <h3 class="logo-brand">
                    <!-- <i class="display-6 align-self-center bi bi-brush"></i> -->
                    {{ config('app.name', 'Laravel') }}

                </h3>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div id="navbarSupportedContent" class="collapse navbar-collapse">
                <ul class="navbar-nav d-none d-sm-block d-md-none me-auto">
                    <li class="navbar-item">
                        test
                    </li>
                </ul>
            </div>

            <div class=" collapse navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav me-5 ms-auto">
                    <!-- Authentication Links -->
                    <ul class="navbar-nav fs-4 h4 mb-2 me-5 mb-lg-0">
                        <li class="navbar-item mx-2">
                            <div class="btn-group">
                                <a type="button" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                                    data-bs-display="static" aria-expanded="true">
                                    <i class="bi bi-compass"></i>
                                    Explore
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
                                    <li><a class="dropdown-item"
                                            href="{{ route('artist.show') }}">{{ __('Artists') }}</a></li>
                                    <li><a class="dropdown-item"
                                            href="{{ route('arts.requests') }}">{{ __('Requests') }}</a></li>
                                    <li><a class="dropdown-item" href="#">{{ __('Marketplace') }}</a></li>
                                </ul>
                            </div>
                        </li>
                        @guest
                            @if (Route::has('login'))
                                <li class="navbar-item mx-2">
                                    <a href="#" class="nav-link nav-size" data-bs-toggle="modal"
                                        data-bs-target="#loginModal">
                                        <i class="bi bi-person-circle pe-2 "></i> Sign in
                                    </a>
                                </li>

                                <li class="navbar-item mx-2">
                                    <a href="#" class="nav-link nav-size" data-bs-toggle="modal"
                                        data-bs-target="#loginModal">
                                        <i class="bi bi-pencil pe-2 "></i> Sign up
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="navbar-item mx-2 dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    @if (Auth::user()->image)
                                        <img class="rounded border border-1 border-dark avatar"
                                            src="{{ asset('/storage/profile/' . Auth::user()->image) }}" alt=""
                                            height="28px" width="28px">
                                    @else
                                        <i class="bi bi-person-circle pe-2 "></i>
                                    @endif
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-dark dropdown-menu-end"
                                    aria-labelledby="navbarDropdown">
                                    <a href="{{ route('user.profile') }}"
                                        class="dropdown-item">{{ __('Profile') }}</a>
                                    <a href="" class="dropdown-item">{{ __('Setting') }}</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                                                                                 document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>

                                </div>
                            </li>

                            <li class="navbar-item mx-2">
                                <a href="#" class="nav-link">
                                    <i class="bi bi-bell"></i>
                                </a>
                            </li>
                            <li class="navbar-item mx-2">
                                <a class="nav-link" type="button" data-bs-toggle="offcanvas"
                                    data-bs-target="#menu" aria-controls="menuScrolling">
                                    <i class="bi bi-list"></i>
                                </a>
                            </li>
                        @endguest



                    </ul>


                </ul>


            </div>


        </div>
    </nav>

    <!-- <nav class="navbar bg-primary navbar-expand-md">
            <div class="container">
                <div class="col-lg-11">
                    <div class="col-lg-5 float-end">
                        <form class="d-flex">
                            <div class="input-group">
                                <input class="form-control" type="search" id="autoSizingInputGroup" placeholder="search for artists, requests, and clients here..." aria-label="search for artists, requests, and clients here...">
                                <button class="input-group-text" type="submit"><i class="bi bi-search"></i></button>
                            </div>
                        </form>
                    </div>
                    </div>
            </div>
        </nav> -->


    <main class="">
        @yield('content')
    </main>
    </div>
</body>

</html>
