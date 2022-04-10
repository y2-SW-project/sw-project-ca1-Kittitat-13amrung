@extends('layouts.app')

@section('content')
    <img src="{{ asset('storage/image/background.svg') }}" alt="background image for main page"
        class="d-lg-block d-sm-none d-md-none d-none img-fluid background-img">
    <div class="container-fluid">
        <main class="container">
            <div class="main-header row pt-5 mb-4">
                <!-- left main -->
                <div class="col-lg-6">
                    <h1 class="display-2 text-uppercase">{{ __('art.request?') }}</h1>
                    <p class="paragraph col-lg-11">{{ __('art.description') }}</p>
                    <div class="d-grid gap-3 d-sm-block mx-auto my-5">
                        <a href="#" class="btn btn-success text-uppercase col-lg-5 btn px-5 py-3 rounded-pill">
                            <i class="fs-3 bi bi-compass"></i>
                            <span class="fs-4">{{ __('Explore') }}</span>
                        </a>
                        <a href="{{ route('arts.requests') }}"
                            class="btn btn-outline-dark text-uppercase col-lg-5 btn mx-3 px-5 py-3 rounded-pill">
                            <i class="fs-3 bi bi-pencil-square"></i>
                            <span class="fs-4">{{ __('Request') }}</span>
                        </a>
                    </div>
                </div>
                <!-- right main -->
                <div class="col-lg-6 ms-auto">
                    <img src="{{ asset('/storage/image/sideMain.svg') }}" class="img-fluid"
                        style="postion: relative;" alt="">
                </div>
            </div>

            <div class="row mt-5 align-items-center">
            </div>
        </main>
    </div>

    <div class="container-fluid">
        <section class="container">

            <div class="py-5">
                <span class="display-5 text-uppercase">
                    <i class="bi bi-file-image"></i>
                    Recent Search
                </span>
                <div class="d-flex mt-5">

                </div>
            </div>
        </section>
    </div>

    <hr>

    <section class="container my-5">
        <div class="text-center my-5">
            <span class="display-5 text-uppercase">
                <i class="bi bi-brush"></i>
                Popular Artists
            </span>
        </div>
        <div class="row">
            @foreach ($artists as $artist)
                <div class="col-xl-4 col-lg-6 col-md-12 mb-md-5 mb-5 col-sm-12">
                    <div class="artist">
                        <a href="{{ route('artist.view', $artist->id) }}" class="nav-item">
                            <div id="artistCarouselIndicators{{ $artist->id }}" class="carousel slide"
                                data-bs-ride="carousel">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#artistCarouselIndicators{{ $artist->id }}"
                                        data-bs-slide-to="0" class="active" aria-current="true"
                                        aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#artistCarouselIndicators{{ $artist->id }}"
                                        data-bs-slide-to="1" aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#artistCarouselIndicators{{ $artist->id }}"
                                        data-bs-slide-to="2" aria-label="Slide 3"></button>
                                </div>
                                <div
                                    class="carousel-inner w-100 img-container rounded rounded-5 border-top border-end border-2 mx-auto">
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
                                <div class="col-lg-2 col-md-2 col-sm-1 col-1">
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

                                    <h2 class="h4">
                                        {{ $artist->users->name }}
                                    </h2>
                                    <h6 class="price small text-muted">
                                        Around {{ '€' . $artist->start_price . '- €' . $artist->end_price }}</h6>
                                </div>

                                <div class="col-lg-5 col-md-7 col-sm-6 col-6 block align-self-center">
                                    <div class="navbar-item fs-5 text-lg-end text-md-center text-sm-end text-end">
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

        <div class="row">
            <div class="col-lg-10"></div>
            <div class="col-lg-2">
                <div class="">
                    <a href="{{ route('artist.show') }}" class="nav-link text-end text-dark fs-5">
                        <span>
                            view more
                            <i class="bi bi-arrow-right-circle"></i>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
