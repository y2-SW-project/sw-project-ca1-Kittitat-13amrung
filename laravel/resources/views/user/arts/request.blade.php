@extends ('layouts.app')
<script src="{{ asset('js/request.js') }}" defer></script>
@section('content')
    <img src="{{ asset('storage/image/background.svg') }}" alt="background image for main page"
        class="d-md-block d-none img-fluid background-img">
    <main class="container">
        <div class="row">
            <div class="display-6 text-center my-5">
                <i class="display-2 bi bi-person-circle"></i>
                {{ __('Requested From Clients') }}
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="text-end">
                    <a href="{{ route('arts.requests.create') }}" class="btn btn-dark rounded-pill p-3 px-5">
                        {{ __('Create A Request') }}
                    </a>
                </div>
            </div>
        </div>

        <div class="d-flex">

            <div class="col-lg-4">
                @foreach ($clients as $client)
                    <div class="my-5" id="request{{ $client->id }}" defer>
                        <div class="card border-bottom">
                            <h6 class="text-start card-subtitle">
                                @if ($client->commercial_use == '1')
                                    <span
                                        class="text-white border-bottom border-end border-4 border-muted rounded-pill px-3 py-1 bg-tertiary">
                                        Commercial Uses
                                    </span>
                                @else
                                    <span
                                        class="text-white border-bottom border-end border-4 border-muted rounded-pill px-3 py-1 bg-secondary">
                                        Personal Uses
                                    </span>
                                @endif
                            </h6>
                            <div class="genre m-3 justify-content-around text-white">

                                <div class="float-end">
                                    @if ($client->digital_art == 1)
                                        <span
                                            class="ms-auto p-2 mx-2 small rounded-pill bg-primary text-capitalize pill-hover">
                                            Digital Art
                                        </span>
                                    @endif

                                    @if ($client->traditional_art == 1)
                                        <span
                                            class="ms-auto p-2 mx-2 small rounded-pill bg-secondary text-capitalize pill-hover">
                                            Traditional Art
                                        </span>
                                    @endif

                                    @if ($client->pixel_art == 1)
                                        <span
                                            class="ms-auto p-2 mx-2 small rounded-pill bg-danger text-capitalize pill-hover">
                                            Pixel Art
                                        </span>
                                    @endif

                                </div>

                            </div>

                            <div class="request-pointer card-body text-center"
                                onclick="window.fetchRequest({{ $client->id }})">
                                <!-- <i class="fs-4 bi bi-folder2-open"></i> -->
                                <h3 class="mb-5 text-capitalize card-title">
                                    <i class="fs-1 bi bi-info-circle"></i>
                                    {{ $client->title }}
                                </h3>
                                <div class="h4 text-start card-text">
                                    <hr>
                                    Description: <span class="paragraph">
                                        {{ $client->descriptions }}
                                    </span>
                                    <hr>
                                    Deadline: <span class="paragraph">
                                        {{ date('d-m-Y', strtotime($client->end_date)) }} (In {{ $client->days }}
                                        days)
                                    </span>
                                    <hr>
                                    Entitled Price: <span class="paragraph">
                                        €{{ $client->start_price }} to €{{ $client->end_price }}
                                    </span>
                                    <hr>
                                    <div class="text-end small">
                                        Requested By: <span class="paragraph">
                                            {{ $client->users->name }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="position-relative w-100 ms-3 rounded rounded-5 my-5 bg-light">
                <div class="row ms-auto sticky">
                    <div id="requestTable">

                    </div>
                </div>
            </div>

    </main>
@endsection
