<main class="container mt-5">

    <div class="position-relative mt-5 d-flex">

        <div class="col-lg-4 text-center text-light profile bg-dark rounded rounded-5">
            <br>

            <div class="artist-panel">

            <div class="d-lg-flex d-md-block pe-5">

                    @if (Auth::user()->image)
                    <img class="w-25 h-25 ms-5 d-lg-none d-none d-xl-block user-img rounded avatar border border-dark border-1" src="{{ asset('/storage/profile/' . Auth::user()->image) }}"
                        alt="avatar" id="avatar">
                @else 
                <img class="w-25 h-25 ms-5 d-lg-none d-none d-xl-block user-img rounded avatar borde border-dark border-1" id="avatar" alt="avatar" src="https://via.placeholder.com/280">
                @endif

                <h2 class="text-primary display-6 mt-3 text-md-end text-start text-xl-start mx-auto">
                    {{ Auth::user()->name }}
                </h2>
            
            </div>
            
            <hr>

            <ul class="navbar-nav fs-2">

                <a href="{{ route('user.profile') }}" class="nav-link nav-size text-primary">
                    <li class="navbar-item nav-menu py-4">
                        <i class="bi bi-person"></i>
                        {{ __('User Profile') }}
                    </li>
                </a>

                @can('artist')
                <a href="{{ route('user.profile.artist') }}" class="nav-link nav-size text-primary">
                    <li class="navbar-item nav-menu py-4">
                        <i class="bi bi-brush"></i>
                        {{ __('Artist Profile') }}
                    </li>
                </a>
                @endcan
                <a href="{{ url('/') }}" class="nav-link nav-size text-primary">
                    <li class="navbar-item nav-menu py-4">
                        <i class="bi bi-bell"></i>
                        {{ __('Notifications') }}
                    </li>
                </a>
                <a href="{{ route('user.requests.list') }}" class="nav-link nav-size text-primary">
                    <li class="navbar-item nav-menu py-4">
                        <i class="bi bi-pencil-square"></i>
                        {{ __('Your Requests') }}
                    </li>
                </a>
                <a href="{{ route('user.favourites') }}" class="nav-link nav-size text-primary">
                    <li class="navbar-item nav-menu py-4">
                        <i class="bi bi-heart"></i>
                        {{ __('Favourites') }}
                    </li>
                </a>

                <a class="nav-link nav-size text-primary" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                                                                                                                                                                                                                                                                                                                                                     document.getElementById('logout-form').submit();">
                    <li class="navbar-item nav-menu py-4">
                        {{ __('Logout') }}

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </a>
            </ul>
        </div>
    </div>
