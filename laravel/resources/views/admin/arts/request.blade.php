@extends ('layouts.app')

@section('content')
    <main class="container">
        <div class="row">
            <div class="display-6 text-center my-5">
                <i class="display-2 bi bi-person-circle"></i>
                {{ __('Requested From Clients')}}
            </div>
        </div>
        <div class="row display-flex">
            @foreach ($requests as $request)
            <div class="my-5 col-lg-4 col-md-6 col-sm-12">
                <div class="card">
                    <h6 class="text-start card-subtitle">
                        @if ($request->commercial_use == "yes")   
                            <span class="text-white rounded-pill px-3 py-1 bg-tertiary">
                                Commercial Uses
                            </span>
                            @else
                            <span class="text-white rounded-pill px-3 py-1 bg-secondary">
                                Personal Uses
                            </span>
                            @endif
                        </h6>
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
                    <a class="nav-link text-dark" href="#">
                    <div class="card-body text-center">
                        <!-- <i class="fs-4 bi bi-folder2-open"></i> -->
                        <h3 class="mb-5 text-capitalize card-title">
                                <i class="fs-1 bi bi-info-circle"></i>
                                {{ $request->title }}
                            </h3>
                            <div class="h4 text-start card-text">
                                <hr>
                                Deadline: <span class="paragraph">
                                    {{ date('d-m-Y', strtotime($request->end_date)) }} (In {{ $request->days }} days)
                                </span>
                                <hr>
                                Entitled Price: <span class="paragraph">
                                    €{{ $request->start_price }} to €{{ $request->end_price }}
                                </span>
                                <hr>
                            </div>
                        </div>
                    </a>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
@endsection