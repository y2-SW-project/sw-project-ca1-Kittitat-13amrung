@extends('layouts.app')

@section('content')
{{-- <img src="{{ asset('storage/image/Lourve.svg') }}" alt="background image for main page"
    class="background-img"> --}}
<div class="container-fluid main-header border-light border-bottom border-3">
        <main class="container">
            {{-- <div class="row pt-5">

            </div> --}}
            <div class="row intro">
                <!-- left main -->
                <div class="col-lg-6 pt-5">
                    <h1 class="display-3 text-capitalized text-light nav-text"><span class="looking">{{ __('art.looking') }}</span>{{ __('art.request?') }}</h1>
                    <p class="paragraph col-lg-11 nav-paragraph">{{ __('art.description') }}</p>
                    <div class="d-grid gap-3 d-sm-block mx-auto my-5">
                        <a href="#" class="artist position-relative btn btn-primary text-uppercase col-lg-5 btn px-5 rounded-pill">
                            <i class="fs-3 bi bi-compass"></i>
                            <span class="fs-4">{{ __('Explore') }}</span>
                        </a>
                        <a href="{{ route('arts.requests') }}"
                            class="artist position-relative btn btn-outline-light text-uppercase col-lg-5 btn mx-3 px-5 rounded-pill">
                            <i class="fs-3 bi bi-pencil-square"></i>
                            <span class="fs-4">{{ __('Request') }}</span>
                        </a>
                    </div>
                </div>
                <!-- right main -->
                <div class="col-lg-6 ms-auto">
                    {{-- <img src="{{ asset('/storage/image/sideMain.svg') }}" class="img-fluid"
                        style="postion: relative;" alt=""> --}}
                </div>
            </div>
        </main>
    </div>
    {{-- {{ dd(session('artists')) }} --}}
    @if(Auth::check() and !is_null(session('recentSearch')))
    <div class="container-fluid">
        <section class="container">
                <div class="text-start py-5">
                    <span class="display-5 text-uppercase">
                        <i class="bi bi-file-image"></i>
                        Recent Search
                    </span>
                    <div class="row mt-5">
                        {{-- @each('layouts.recentSearch', $recents, 'artist') --}}
                    </div>
                </div>
            </section>
        </div>
    @endif

    {{-- <hr> --}}

    <section class="container">
        <div class="display-5 text-start d-flex my-5">
            <i class="bi bi-award"></i>
            <span class="text-uppercase pt-1">
                Popular Artists
            </span>
            <a href="{{ route('artist.show') }}" class="nav-link mx-3 fs-5 align-self-center pt-3">
                <span>
                    view more
                    <i class="bi bi-arrow-right-circle"></i>
                </span>
                </a>
        </div>
        <div class="row">
            @foreach ($popArtists as $artist)
                <div class="col-xl-4 col-lg-6 col-md-12 mb-md-5 mb-5 col-sm-12">
                    <div class="artist position-relative">
                        <div class="like position-absolute text-light">
                            <i id="like{{ $artist->id }}"
                                @can ('likable') 
                                onclick="window.fetchLike({{$artist->id}})"
                                class="bi {{ Auth::user()->hasLiked($artist) ? 'bi-hand-thumbs-up-fill' : 'bi-hand-thumbs-up' }} fs-2"
                                @else
                                onclick='window.guest("like{{$artist->id}}")'
                                class="bi bi-hand-thumbs-up fs-2" data-toggle="tooltip" title="Sign In Required!" data-placement="top"
                                @endcan
                                ></i>
    
                            <span id="liker{{$artist->id}}-bs3">
                                {{ $artist->likers()->count() }}
                            </span>
                        </div>
                        <div class="favourite position-absolute text-light">
                            <i id="favorite{{ $artist->id }}"
                                @can ('favouritable')
                                onclick="window.fetchFavourite({{$artist->id}})" 
                                class="bi {{ Auth::user()->hasFavorited($artist) ? 'bi-heart-fill' : 'bi-heart' }} fs-2"
                                @else
                                onclick="window.guest('favorite{{ $artist->id }}')" 
                                class="bi bi-heart fs-2" data-toggle="tooltip" title="Sign In Required!" data-placement="top"
                                @endcan
                                ></i>
                        </div>
                        <a href="{{ route('artist.view', $artist->id) }}" class="nav-item artist-link">
                            <div id="popularArtistCarouselIndicators{{ $artist->id }}" class="carousel slide"
                                data-bs-ride="carousel">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#popularArtistCarouselIndicators{{ $artist->id }}"
                                        data-bs-slide-to="0" class="active" aria-current="true"
                                        aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#popularArtistCarouselIndicators{{ $artist->id }}"
                                        data-bs-slide-to="1" aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#popularArtistCarouselIndicators{{ $artist->id }}"
                                        data-bs-slide-to="2" aria-label="Slide 3"></button>
                                </div>
                                <div
                                    class="carousel-inner w-100 img-container rounded-top mx-auto">
                                    <div class="carousel-item active">
                                        <img src="{{ asset('storage/portfolio/1.jpg') }}" class="d-block img-fluid"
                                            alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ asset('storage/portfolio/2.jpg') }}" class="d-block img-fluid"
                                            alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ asset('storage/portfolio/3.jpg') }}" class="d-block img-fluid"
                                            alt="...">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 d-flex py-4 px-4 artist-body">
                                <div class="col-lg-2 col-md-2 col-sm-1 col-1 pt-1">
                                    @if ($artist->users->image)
                                        <img class="profile-img w-100 rounded-circle "
                                            src="{{ asset('/storage/profile/' . $artist->users->image) }}"
                                            alt="profile_image">
                                    @else
                                        <img class="img-fluid w-100"
                                            src="{{ asset('/storage/image/person-circle.svg') }}" alt="profile_image">
                                    @endif
                                </div>

                                <div class="col-lg-4 ms-3">

                                    <h2 class="h4 nav-link px-0">
                                        {{ $artist->users->name }}
                                    </h2>
                                    <h6 class="price small">
                                        Around {{ '€' . $artist->start_price . '- €' . $artist->end_price }}</h6>
                                </div>

                                <div class="col-lg-5 col-md-7 col-sm-6 col-6 block align-self-center">
                                    <div class="navbar-item fs-6 pt-5 text-lg-end text-md-center text-sm-end text-end">
                                        @if ($artist->status == true)
                                            <span class="text-success">
                                                available
                                            </span>
                                        @else
                                            <span class="text-danger">
                                                unavailable
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach

        </div>

    </section>

    <section class="container">
        <div class="display-5 text-start d-flex my-5">
            <i class="bi bi-person-plus"></i>
            <span class="text-uppercase pt-1">
                Artist Freshmen
            </span>
            <a href="{{ route('artist.show') }}" class="nav-link mx-3 fs-5 align-self-center pt-3">
                <span>
                    view more
                    <i class="bi bi-arrow-right-circle"></i>
                </span>
                </a>
        </div>

        <div class="row">
            @foreach ($newArtists as $artist)
            <div class="col-xl-4 col-lg-6 col-md-12 mb-md-5 mb-5 col-sm-12">
                <div class="artist position-relative">
                    <div class="like position-absolute text-light">
                        <i id="like{{ $artist->id }}"
                            @can ('likable') 
                            onclick="window.fetchLike({{$artist->id}})"
                            class="bi {{ Auth::user()->hasLiked($artist) ? 'bi-hand-thumbs-up-fill' : 'bi-hand-thumbs-up' }} fs-2"
                            @else
                            onclick='window.guest("like{{$artist->id}}")'
                            class="bi bi-hand-thumbs-up fs-2" data-toggle="tooltip" title="Sign In Required!" data-placement="top"
                            @endcan
                            ></i>

                        <span id="liker{{$artist->id}}-bs3">
                            {{ $artist->likers()->count() }}
                        </span>
                    </div>
                    <div class="favourite position-absolute text-light">
                        <i id="favorite{{ $artist->id }}" 
                            @can ('favouritable')
                            onclick="window.fetchFavourite({{$artist->id}})" 
                            class="bi {{ Auth::user()->hasFavorited($artist) ? 'bi-heart-fill' : 'bi-heart' }} fs-2"
                            @else
                            onclick="window.guest('favorite{{ $artist->id }}')" 
                            class="bi bi-heart fs-2" data-toggle="tooltip" title="Sign In Required!" data-placement="top"
                            @endcan
                            ></i>
                    </div>
                    <a href="{{ route('artist.view', $artist->id) }}" class="nav-item artist-link">
                        <div id="popularArtistCarouselIndicators{{ $artist->id }}" class="carousel slide"
                            data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#popularArtistCarouselIndicators{{ $artist->id }}"
                                    data-bs-slide-to="0" class="active" aria-current="true"
                                    aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#popularArtistCarouselIndicators{{ $artist->id }}"
                                    data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#popularArtistCarouselIndicators{{ $artist->id }}"
                                    data-bs-slide-to="2" aria-label="Slide 3"></button>
                            </div>
                            <div
                                class="carousel-inner w-100 img-container rounded-top mx-auto">
                                <div class="carousel-item active">
                                    <img src="{{ asset('storage/portfolio/1.jpg') }}" class="d-block img-fluid"
                                        alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('storage/portfolio/2.jpg') }}" class="d-block img-fluid"
                                        alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('storage/portfolio/3.jpg') }}" class="d-block img-fluid"
                                        alt="...">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 d-flex py-4 px-4 artist-body">
                            <div class="col-lg-2 col-md-2 col-sm-1 col-1 pt-1">
                                @if ($artist->users->image)
                                    <img class="profile-img w-100 rounded-circle "
                                        src="{{ asset('/storage/profile/' . $artist->users->image) }}"
                                        alt="profile_image">
                                @else
                                    <img class="img-fluid w-100"
                                        src="{{ asset('/storage/image/person-circle.svg') }}" alt="profile_image">
                                @endif
                            </div>

                            <div class="col-lg-4 ms-3">

                                <h2 class="h4 nav-link px-0">
                                    {{ $artist->users->name }}
                                </h2>
                                <h6 class="price small">
                                    Around {{ '€' . $artist->start_price . '- €' . $artist->end_price }}</h6>
                            </div>

                            <div class="col-lg-5 col-md-7 col-sm-6 col-6 block align-self-center">
                                <div class="navbar-item fs-6 pt-5 text-lg-end text-md-center text-sm-end text-end">
                                    @if ($artist->status == true)
                                        <span class="text-success">
                                            available
                                        </span>
                                    @else
                                        <span class="text-danger">
                                            unavailable
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach

        </div>
    </section>

    @include('layouts.footer')
@endsection
