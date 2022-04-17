@extends ('layouts.app')

@section('content')

<div class="container my-5 pt-5">
    @include('layouts.profile')

    {{-- {{dd($favourites)}} --}}
    <div class="col-7 border">
    @foreach ($favourites as $favourite)
    <div class="">
        <div class="m-5 artist rounded-pill">
            <a href="{{ route('artist.view', $favourite->id) }}" class="nav-item">

                <div class="col-lg-12 d-flex py-4 px-4 artist-body">
                    <div class="col-lg-2 col-md-2 col-sm-1 col-1">
                        @if ($favourite->users->image)
                            <img class="profile-img w-100 rounded-circle "
                                src="{{ asset('/storage/profile/' . $favourite->users->image) }}"
                                alt="profile_image">
                        @else
                            <img class="img-fluid w-100"
                                src="{{ asset('/storage/image/person-circle.svg') }}" alt="profile_image">
                        @endif
                    </div>

                    <div class="col-lg-4 ms-3">

                        <h2 class="h4">
                            {{ $favourite->users->name }}
                        </h2>
                        <h6 class="price small text-muted">
                            Around {{ '€' . $favourite->start_price . '- €' . $favourite->end_price }}</h6>
                    </div>

                    <div class="col-lg-5 col-md-7 col-sm-6 col-6 block align-self-center">
                        <div class="navbar-item fs-6 pt-5 text-lg-end text-md-center text-sm-end text-end">
                            @if ($favourite->status == true)
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
        {!! $favourites->links() !!}
    </div>
</div>
</div>
@endsection