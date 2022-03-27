@extends('layouts.app')

@section('content')
    <main class="container">
        <div class="row">
            <div class="fs-1a text-center text-uppercase my-5">
                <i class="display-3 bi bi-easel"></i>
                {{ __('Artists At Your Service') }}
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="artist">
                    <a href="#" class="nav-item">
                        <div id="artistCarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#artistCarouselIndicators" data-bs-slide-to="0"
                                    class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#artistCarouselIndicators" data-bs-slide-to="1"
                                    aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#artistCarouselIndicators" data-bs-slide-to="2"
                                    aria-label="Slide 3"></button>
                            </div>
                            <div
                                class="carousel-inner w-100 img-container rounded rounded-5 border-top border-end border-4 mx-auto">
                                <div class="carousel-item active">
                                    <img src="{{ asset('storage/portfolio/1.jpg') }}" class="d-block img-fluid" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('storage/portfolio/2.jpg') }}" class="d-block img-fluid" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('storage/portfolio/3.jpg') }}" class="d-block img-fluid" alt="...">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 d-flex py-4 px-4 artist-body">
                            <div class="col-lg-2">
                                @if (Auth::user()->image)
                                    <img class="profile-img img-fluid rounded-circle "
                                        src="{{ asset('/storage/profile/' . Auth::user()->image) }}" alt="profile_image">
                                @endif
                            </div>

                            <div class="col-lg-4 ms-3">

                                <h2 class="d-block">
                                    {{ Auth::user()->name }}
                                </h2>
                                <h6 class="d-block price small text-muted">€25 - €75</h6>
                            </div>

                            <div class="col-lg-5 align-self-center">
                                <div class="d-block navbar-item dropdown text-end">
                                    <span class="text-success">
                                        available
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>




        </div>
    @endsection
