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
                        <a href="{{route('artist.show')}}" class="artist position-relative btn btn-primary text-uppercase col-lg-5 btn px-5 rounded-pill">
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
                        @each('templates.artist-caroussel', $recents, 'artist')
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
                @each('templates.artist-caroussel', $popArtists, 'artist')
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
            @each('templates.artist-caroussel', $newArtists, 'artist')

        </div>
    </section>

    @include('layouts.footer')
@endsection
