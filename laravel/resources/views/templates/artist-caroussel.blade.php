<div class="col-xl-4 col-lg-6 col-md-12 mb-md-5 mb-5 col-sm-12">
    <div class="artist position-relative">
        <div class="like position-absolute text-light">
            {{-- {{dd($artist)}} --}}
            <i id="like{{ $artist->id }}"
                @can ('likable' ) 
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
                data-bs-ride="carousel" data-bs-interval="7000">
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
                        <img src="{{ (!is_null($artist->img1)) ?
                            asset('storage/artists/thumbnails/'.$artist->img1.'.jpg') : asset('storage/artists/thumbnails/1.jpg') }}" class="d-block img-fluid"
                            alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ (!is_null($artist->img2)) ?
                            asset('storage/artists/thumbnails/'.$artist->img2.'.jpg') : asset('storage/artists/thumbnails/2.jpg') }}" class="d-block img-fluid"
                            alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ (!is_null($artist->img3)) ?
                            asset('storage/artists/thumbnails/'.$artist->img3.'.jpg') : asset('storage/artists/thumbnails/3.jpg') }}" class="d-block img-fluid"
                            alt="...">
                    </div>
                </div>
            </div>
            <div class="col-lg-12 d-flex py-4 px-4 artist-body">
                <div class="col-lg-2 col-md-2 col-sm-1 col-1 pt-1">
                    @if ($artist->users->image)
                        <img class="profile-img w-100 rounded-circle " draggable="false"
                            src="{{ asset('/storage/profile/' . $artist->users->image . '.jpg') }}"
                            alt="profile_image">
                    @else
                        <img class="img-fluid w-100" draggable="false"
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