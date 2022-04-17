@extends('layouts.app')

@section('content')
    <script src="{{ asset('js/artists.js') }}"></script>
    <main class="container intro">
        <div class="row">
            <div class="display-5 text-start d-flex my-5">
                <i class="me-3 bi bi-cart-plus"></i>
                <span class="text-uppercase pt-1">
                    {{ __('Artists At Your Service') }}
                </span>
            </div>
        </div>
        <div class="d-flex justify-content-end ms-3 mb-5">
            <div class="col-lg-3">
                <div class="form-floating">
                    <select class="form-select bg-primary text-white" id="sorting" aria-label="Sort by">
                      <option selected>Newest</option>
                      <option value="1">Oldest</option>
                      <option value="2">Alphabetical</option>
                      <option value="4">Low to High Price</option>
                      <option value="3">High to Low Price</option>
                    </select>
                    <label for="sorting" class="text-light">
                        Sort by:</label>
                  </div>
            </div>
        </div>
        {{-- {{dd(Auth::user()->hasLiked($artist))}} --}}
        <div class="row">
            @foreach ($artists as $artist)
            <div class="col-xl-4 col-lg-6 col-md-12 mb-md-5 mb-5 col-sm-12">
                <div class="artist position-relative">
                    <div class="like position-absolute text-light">
                        <i id="like{{ $artist->id }}" onclick="window.fetchLike({{$artist->id}})" class="bi {{ Auth::user()->hasLiked($artist) ? 'bi-hand-thumbs-up-fill' : 'bi-hand-thumbs-up' }} fs-2"></i>
                        <span id="liker{{$artist->id}}-bs3">
                            {{ $artist->likers()->count() }}
                        </span>
                    </div>
                    <div class="favourite position-absolute text-light">
                        <i id="favorite{{ $artist->id }}" onclick="window.fetchFavourite({{$artist->id}})" class="bi {{ Auth::user()->hasFavorited($artist) ? 'bi-heart-fill' : 'bi-heart' }} fs-2"></i>
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


            <div class="d-flex justify-content-center">
                {!! $artists->links() !!}
            </div>


            @include('layouts.footer')
        </div>
    @endsection
