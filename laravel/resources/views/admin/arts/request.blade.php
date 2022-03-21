@extends ('layouts.app')

@section('content')
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

        <script src="{{ asset('js/request.js') }}" defer></script>
        @if (count($clients) === 0)
            <div class="h4 text-center mark my-5 p-5 rounded rounded-5 border-bottom border-end border-5 border-muted">
                There are currently no requests by any client.
                <h4 class="pt-5">Please check back later.</h4>
            </div>
        @else
            <div class="d-flex">

                <div class="col-lg-4">
                    @foreach ($clients as $client)
                        <div class="my-5  border-3" onclick="getId()" id="request{{ $client->id }}">
                            <div class="card">
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
                                <div class="genre m-3 justify-content-around">

                                    <div class="float-end">
                                        @if ($client->digital_art == 1)
                                            <span class="ms-auto p-2 mx-2 small rounded-pill bg-primary text-capitalize">
                                                Digital Art
                                            </span>
                                        @endif

                                        @if ($client->traditional_art == 1)
                                            <span class="ms-auto p-2 mx-2 small rounded-pill bg-primary text-capitalize">
                                                Traditional Art
                                            </span>
                                        @endif

                                        @if ($client->pixel_art == 1)
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
                                            {{ $client->title }}
                                        </h3>
                                        <div class="h4 text-start card-text">
                                            <hr>
                                            Description: <span class="paragraph">
                                                {{ $client->descriptions }}
                                            </span>
                                            <hr>
                                            Deadline: <span class="paragraph">
                                                {{ date('d-m-Y', strtotime($client->end_date)) }} (In
                                                {{ $client->days }}
                                                days)
                                            </span>
                                            <hr>
                                            Entitled Price: <span class="paragraph">
                                                €{{ $client->start_price }} to €{{ $client->end_price }}
                                            </span>
                                            <hr>
                                            <div class="text-end small">
                                                Requested By: <span class="paragraph">
                                                    {{ $client->users[0]->name }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="sticky request-select w-100 ms-3 rounded rounded-5 my-5 bg-secondary">
                    <div class="row">
                        <h1 class="h2 text-center">
                        </h1>
                    </div>
                </div>
        @endif
    </main>
@endsection
