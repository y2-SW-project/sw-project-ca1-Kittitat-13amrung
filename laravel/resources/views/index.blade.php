@extends('layouts.app')

@section ('content')
<div class="container-fluid">
    <main class="container">
        <div class="main-header row pt-5 mb-4">
            <!-- left main -->
            <div class="col-lg-6">
                <h1 class="display-2 text-uppercase">{{ __('art.request?') }}</h1>
                <p class="paragraph col-lg-11">{{ __('art.description') }}</p>
                <div class="d-grid gap-3 d-sm-block mx-auto my-5">
                    <a href="#" class="btn btn-success text-uppercase col-lg-5 btn mx-3 px-5 py-3 rounded-pill">
                        <i class="fs-3 bi bi-compass"></i>
                        <span class="fs-4">{{ __('Explore') }}</span>
                    </a>
                    <a href="{{ route('arts.requests') }}" class="btn btn-outline-dark text-uppercase col-lg-5 btn mx-3 px-5 py-3 rounded-pill">
                    <i class="fs-3 bi bi-pencil-square"></i>
                    <span class="fs-4">{{ __('Request') }}</span>
                    </a>
                </div>
            </div>
            <!-- right main -->
            <div class="col-lg-6 ms-auto">
            <img src="{{asset('/storage/image/sideMain.svg')}}" class="img-fluid" style="postion: relative;" alt="">
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
                @foreach ($cars as $car)
                    @continue($car->id == 0)
                <div data-id="{{ $car->id }}" class="col-3 my-2 mx-5">
                    <a href="{{ route('user.cars.show', $car->id) }}">
                        @if ($car->image_location)
                        <img src="{{ asset('/storage/image/'.$car->image_location )}}" class="img-fluid my-2 mx-2" alt="{{ ' ' . $car->make . ' ' . $car->model}}">
                        @else
                        <img src="{{ asset('/storage/image/img-preview.svg') }}" class="img-fluid my-2 mx-2" alt="{{ ' ' . $car->make . ' ' . $car->model}}">
                        @endif
                    </a>
                    </div>
                    @break($car->id == 3)
                    @endforeach
                </div>
            </div>
</section>
</div>

            <hr>

            <section class="container my-5">
                <div class="text-center">
                    <span class="display-5 text-uppercase">
                    <i class="bi bi-brush"></i>
                    Popular Artists
                    </span>
                </div>
                <div class="row mt-5">
                    <div class="d-flex">
                    <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            test
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            test
                        </div>
                    </div>
                </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-10"></div>
                    <div class="col-lg-2">
                        <div class="">
                            <a href="#" class="nav-link text-end text-dark fs-5">
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

