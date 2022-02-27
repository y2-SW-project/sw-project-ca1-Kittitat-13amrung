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

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- resources/views/layouts/app.blade.php -->

    <!-- <style>
    .chat {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .chat li {
        margin-bottom: 10px;
        padding-bottom: 5px;
        border-bottom: 1px dotted #B3A9A9;
    }

    .chat li .chat-body p {
        margin: 0;
        color: #777777;
    }

    .panel-body {
        overflow-y: scroll;
        height: 350px;
    }

    ::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        background-color: #F5F5F5;
    }

    ::-webkit-scrollbar {
        width: 12px;
        background-color: #F5F5F5;
    }

    ::-webkit-scrollbar-thumb {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
        background-color: #555;
    }
    </style> -->
</head>
<body>
    <div id="app">
    <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="menu" aria-labelledby="menuLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Colored with scrolling</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <p>Try scrolling the rest of the page to see this option in action.</p>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="login modal" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <span></span>
                        <h6 class="modal-title fs-4" id="login">
                            <i class="fs-2 bi bi-person-circle pe-2 "></i>
                            {{ __('Login') }}
                        </h6>
                        <a href="#" class="fs-4 nav-link active">
                            <span data-bs-dismiss="modal" aria-hidden="true">&times;</span>
                        </a>
                </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            
                            <div class="row justify-content-center mb-3">
                                <label for="email" class="col-md-8 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-8">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row justify-content-center mb-3">
                                <label for="password" class="col-md-8 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-8">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

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
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-12 offset-md-2">
                                    <button type="submit" class="btn btn-primary col-md-8">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('register'))
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link offset-md-2" href="{{ route('register') }}"> {{ __('Not sign up yet? Sign Up') }}</a>
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
        <nav class="navbar navbar-expand-md navbar-light">
            <div class="container">
                <a class="navbar-brand fw-bold fs-1" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
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

                            <ul class="navbar-nav mb-2 mx-5 mb-lg-0">
                                <li class="navbar-item">
                                <div class="btn-group">
                                    <a type="button" class="nav-link active dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="true">
                                        <i class="fs-2 bi bi-compass"></i>
                                        Explore 
                                    </a>        
                                    <ul class="dropdown-menu dropdown-menu-lg-end">
                                        <li><a class="dropdown-item" href="#">Menu item</a></li>
                                        <li><a class="dropdown-item" href="#">Menu item</a></li>
                                        <li><a class="dropdown-item" href="#">Menu item</a></li>
                                    </ul>
                                </div>
                                </li>
                                
                                <li class="navbar-item">
                                        <a href="#" class="nav-link nav-size active" data-bs-toggle="modal" data-bs-target="#loginModal">
                                        <i class="fs-2 bi bi-person-circle pe-2 "></i> Log in
                                        </a>
                                </li>

                                <li class="navbar-item">
                                <a class="nav-link nav-size active" type="button" data-bs-toggle="offcanvas" data-bs-target="#menu" aria-controls="menuScrolling">
                                <i class="fs-2 bi bi-list fw-bold"></i>
                                </a>
                                </li>

                            </ul>

                            
                                <!-- <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li> -->
                            @endif
                        @else
                        <ul class="navbar-nav mb-2 mx-5 mb-lg-0">
                            <li class="navbar-item">
                                    <div class="btn-group">
                                        <a type="button" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="true">
                                            <i class="fs-2 bi bi-compass"></i>
                                            Explore 
                                        </a>        
                                        <ul class="dropdown-menu dropdown-menu-lg-end">
                                            <li><a class="dropdown-item" href="#">Menu item</a></li>
                                            <li><a class="dropdown-item" href="#">Menu item</a></li>
                                            <li><a class="dropdown-item" href="#">Menu item</a></li>
                                        </ul>
                                    </div>
                                    </li>

                                    <li class="navbar-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            <i class="fs-2 bi bi-person-circle pe-2 "></i>
                                            {{ Auth::user()->name }}
                                        </a>
            
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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

                                    <li class="navbar-item">
                                        <a href="#" class="nav-link">
                                            <i class="fs-3 bi bi-bell"></i>
                                        </a>
                                    </li>

                                    <li class="navbar-item">
                                    <a class="nav-link nav-size" type="button" data-bs-toggle="offcanvas" data-bs-target="#menu" aria-controls="menuScrolling">
                                    <i class="fs-2 bi bi-list fw-bold"></i>
                                    </a>
                                    </li>

                                    
                                </ul>
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
