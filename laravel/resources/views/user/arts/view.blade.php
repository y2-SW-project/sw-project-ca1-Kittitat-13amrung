        @extends ('layouts.app')
        @section('content')
        <main class="container intro mt-5">
                <!-- Large modal -->
                {{-- <button type="button" class="btn btn-primary" data-toggle="modal" onclick="$('#test').modal('toggle')" data-target=".bd-example-modal-lg">Large modal</button> --}}
                
                <div class="modal fade bd-example-modal-lg" tabindex="-10" role="dialog" id="test" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content col-lg-12">
                        <div class="modal-body">

<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="d-block w-100" src="{{asset('storage/artists/arts/'.$artist->img1)}}" alt="First slide">
      </div>
      <div class="carousel-item">
          <img class="d-block w-100" src="{{asset('storage/artists/arts/'.$artist->img2)}}" alt="Second slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="{{asset('storage/artists/arts/'.$artist->img3)}}" alt="Third slide">
        </div>
      </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
                    </div>
                    </div>
                  </div>
                </div>

                <script src="{{ asset('js/artistShow.js') }}" defer></script>
                <div class="row">
                    <div class="col-lg-8 rounded bg-light border-start border-end  p-5">
                        <input type="hidden" name="view" id="view" value="{{ $artist->description }}">
                        <div id="viewer"></div>
                    </div>

                    <div class="rounded text-primary bg-dark rounded border-end border-bottom border-primary border-4 col-lg-3 artist-panel h-25 ps-4 ms-sm-0 text-sm-center text-xl-start d-sm-block d-md-block-inline ms-xl-4 py-3">

                        <div class="position-relative">
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
                            {{-- {{dd($artist->users->image)}} --}}
                            @if($artist->users->image)
                            <img src="{{ asset('storage/profile/'.$artist->users->image.'.jpg') }}" draggable="false" alt="" class="img-fluid rounded border border-light">
                            @endif
                        </div>
                        <div class="mt-3 h3 ">
                            {{ $artist->users->name }} 
                            @if (Cache::has('user-is-online-' . $artist->users->id))
                            <h6 class="paragraph fs-6 badge bg-success text-light">Online</h6>
                        @else
                            <h6 class="paragraph fs-6 badge bg-tertiary text-dark">Offline {{($artist->days)}}</span>
                        @endif
                        </div>
                        @if ($artist->status == 1)
                        <p class="text-success text-opacity-50">Currently accepting commission</p>
                        @else
                        <p class="text-danger text-opacity-50">Currently not accepting commission</p>
                        @endif
                        <h2 class="h5 my-3">
                            <i class="bi bi-tag-fill me-2"></i>
                            Price Range: 
                        </h2>
                        <h3 class="h6 paragraph text-light text-opacity-75">From €{{ $artist->start_price }} To €{{ $artist->end_price }}</h3>
                        <h2 class="h5 my-3">
                            <i class="bi bi-calendar4-week me-2"></i>
                            Duration Per Commission: 
                        </h2>
                        <h3 class="h6 paragraph text-light text-opacity-75">Usually takes up to {{$artist->duration}} days</h3>


                        <div class="col-lg-12 d-flex justify-content-between text-end pe-3 mt-3">
                            <div class="like text-light">
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
                            @can ('isArtist', $artist)
                            <a href="{{ route('user.profile.artist') }}" class="text-light text-opacity-75 btn btn-primary align-self-center">Edit Profile</a>
                            @endcan
                            <button class="text-light text-opacity-75 btn btn-primary align-self-center">Message</button>
                        </div>

                        <div class="d-flex mt-4 border-top px-3">
                            {{-- <a href="#">test</a> --}}
                            <div class="col-lg-4">
                                <img src="{{asset('storage/artists/thumbnails/'.$artist->img1)}}" alt="" onclick="$('.bd-example-modal-lg').modal('toggle');
                                $('#carouselExampleControls').carousel(0);
                            // $('.bd-example-modal-lg').on('shown.bs.modal', function () {
                            // });
                            " class="img-fluid w-75 label flex-fill">
                            </div>
                            <div class="col-lg-4">
                                <img src="{{asset('storage/artists/thumbnails/'.$artist->img2)}}" alt="" onclick="$('.bd-example-modal-lg').modal('toggle');
                                $('#carouselExampleControls').carousel(1);
                            // $('.bd-example-modal-lg').on('shown.bs.modal', function () {
                            // });
                            " class="img-fluid w-75 label flex-fill">
                            </div>
                            <div class="col-lg-4">
                                <img src="{{asset('storage/artists/thumbnails/'.$artist->img3)}}" alt="" onclick="$('.bd-example-modal-lg').modal('toggle');
                                $('#carouselExampleControls').carousel(2);
                            // $('.bd-example-modal-lg').on('shown.bs.modal', function () {
                            // });
                            " class="img-fluid w-75 label flex-fill">
                            </div>
                        </div>
                    </div>
                </div>
            </main>
          @include('layouts.footer')
        @endsection
