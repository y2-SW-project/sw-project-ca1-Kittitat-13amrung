@extends ('layouts.app')

@section('content')
    <main class="container">
        <div class="row">
            <div class="display-4 text-center my-5">
                <i class="display-2 bi bi-person-circle"></i>
                {{ __('Requested From Clients')}}
            </div>
        </div>

        <div class="row">
            @foreach ($requests as $request)
            <div class="col-lg-4 my-3">
                <div class="card">

                    @if ($request->commercial_use == "yes")   
                    <h6 class="text-start card-subtitle mb-2">
                        <span class="text-dark rounded-pill px-3 py-1 bg-secondary">
                            Client Accepts Commerical Rate
                        </span>
                    </h6>
                    @endif
                    <div class="genre m-3 justify-content-around">

                    <div class="float-end">

                        @if ($request->digital_art == 1)
                        <span class="ms-auto p-2 mx-2 small rounded-pill bg-primary text-capitalize">
                            Digital Art
                        </span>
                        @endif

                        @if ($request->traditional_art == 1)
                        <span class="ms-auto p-2 mx-2 small rounded-pill bg-primary text-capitalize">
                                Traditional Art
                        </span>
                        @endif
                            
                        @if ($request->pixel_art == 1)
                        <span class="ms-auto p-2 mx-2 small rounded-pill bg-primary text-capitalize">
                            Pixel Art
                        </span>
                        @endif

                        </div>

                    </div>
                    <div class="m-3 card-body text-center">
                        <h3 class="my-4 text-capitalize card-title">
                                {{ $request->title }}
                        </h3>
                            <div class="h4 text-start card-text">
                                <hr>
                            <hr>
                            
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </main>
@endsection