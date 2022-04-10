@extends ('layouts.app')
<script src="{{ asset('js/request.js') }}" defer></script>

@section('content')
    {{-- <img src="{{ asset('storage/image/background.svg') }}" alt="background image for main page"
        class="d-md-block d-none img-fluid background-img"> --}}
    <main class="container">
        <div class="d-flex justify-content-around">
            <div class="display-6">
                <i class="display-2 bi bi-person-circle"></i>
                {{ __('Requested From Clients') }}
            </div>
            <div class="my-3">
                <a href="{{ route('arts.requests.create') }}" class="btn btn-dark rounded-pill p-3 px-5">
                    {{ __('Create A Request') }}
                </a>
            </div>
        </div>

        <div class="row">
        </div>

        <div class="d-flex">

            <div class="requests">

                <div class="col-lg-12">
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
                                        Description: <span class="paragraph" id="description">
                                            {{ $client->description }}
                                        </span>
                                        <hr>
                                        Deadline: <span class="paragraph">
                                            {{ date('d-m-Y', strtotime($client->end_date)) }} <span
                                                class="fw-bold small">(About {{ $client->days }}
                                                due date) </span>
                                        </span>
                                        <hr>
                                        Entitled Price: <span class="paragraph">
                                            €{{ $client->start_price }} to €{{ $client->end_price }}
                                        </span>
                                        <hr>
                                        <div class="d-flex justify-content-between">
                                            <span class="text-muted fs-6 paragraph">
                                                View Request
                                            </span>
                                            <p class="paragraph">
                                                {{ $client->users->name }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex text-center request-btn">
                                    {{-- {{ dd(auth()->user()->role == 1) }} --}}
                                    @if (!Auth::guest())
                                        @if ($client->users->id == Auth::user()->id or auth()->user()->role == 1)
                                            <a href="{{ route('arts.requests.edit', $client->id) }}"
                                                class="request-btn rounded-0 text-success btn-lg w-50">Edit
                                                Request</a>
                                            <form action="{{ route('arts.requests.delete', $client->id) }}"
                                                method="post">
                                                @csrf
                                                <button
                                                    class="request-btn btn rounded-0 btn-outline-danger btn-lg w-100">Delete
                                                    Request</button>
                                            </form>
                                        @endif
                                    @endif
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>

            </div>

            <div class="position-relative col-lg-7 my-5">
                <div class="p-2 sticky request-show border-end border-bottom border-3 ms-3 rounded rounded-5 bg-light"
                    id="req-detail">
                    <div class="tags d-flex">
                        <div class="my-5 pe-5 mx-1 me-auto text-start" id="commTag"></div>
                        <div class="my-5 pe-5 mx-2 ms-auto text-white text-end" id="artTag"></div>
                    </div>
                    <div id="requestTitle">
                    </div>
                    <div class="request-select px-3" id="requestBody">
                    </div>
                </div>
            </div>

    </main>
@endsection
