<div class="my-5 artist" id="request{{ $commission->id }}" defer>
    <div class="card border-bottom">
        <h6 class="text-start card-subtitle">

            @if ($commission->commercial_use == '1')
                <span
                    class="text-white border-bottom border-end border-4 border-muted rounded-pill px-3 py-1 bg-tertiary">
                    Commercial Uses
                </span>
            @else
                <span
                    class="text-white border-bottom border-end border-4 border-muted rounded-pill px-3 py-1 bg-primary">
                    Personal Uses
                </span>
            @endif
        </h6>
        <div class="genre m-3 justify-content-around text-white">

            <div class="float-end">
                @if ($commission->digital_art == 1)
                    <span
                        class="ms-auto p-2 mx-2 small rounded-pill bg-dark text-capitalize pill-hover">
                        Digital Art
                    </span>
                @endif

                @if ($commission->traditional_art == 1)
                    <span
                        class="ms-auto p-2 mx-2 small rounded-pill bg-primary text-capitalize pill-hover">
                        Traditional Art
                    </span>
                @endif

                @if ($commission->pixel_art == 1)
                    <span
                        class="ms-auto p-2 mx-2 small rounded-pill bg-danger text-capitalize pill-hover">
                        Pixel Art
                    </span>
                @endif

            </div>

        </div>

        <div class="request-pointer card-body text-center"
            onclick="window.fetchRequest({{ $commission->id }})">

            <!-- <i class="fs-4 bi bi-folder2-open"></i> -->
            <h3 class="mb-5 text-capitalize card-title">
                <i class="fs-1 bi bi-info-circle"></i>
                {{ $commission->title }}
            </h3>
            <div class="h4 text-start card-text">
                <hr>
                Description: <span class="paragraph" id="description">
                    {{ $commission->description }}
                </span>
                <hr>
                Deadline: <span class="paragraph">
                    {{ date('d-m-Y', strtotime($commission->end_date)) }} <span
                        class="fw-bold small">(About {{ $commission->days }}
                        due date) </span>
                </span>
                <hr>
                Entitled Price: <span class="paragraph">
                    €{{ $commission->start_price }} to €{{ $commission->end_price }}
                </span>
                <hr>
                <div class="d-flex justify-content-between">
                    <span class="text-muted fs-6 paragraph">
                        Requested by:
                    </span>
                    <p class="paragraph">
                        @can ('isClient', $commission)
                        You
                        @else
                        {{ $commission->users->name }}
                        @endcan
                    </p>
                </div>
            </div>
        </div>
        {{-- {{ dd(auth()->user()->role == 1) }} --}}
        @can('isClient', $commission)
        <div class="d-flex text-center request-btn">
                    <a href="{{ route('arts.requests.edit', $commission->id) }}"
                        class="request-btn rounded-0 text-success btn-lg w-50">Edit
                        Request</a>
                    <form action="{{ route('arts.requests.delete', $commission->id) }}"
                        method="post">
                        @csrf
                        <button
                            class="request-btn btn rounded-0 btn-outline-danger btn-lg w-100">Delete
                            Request</button>
                    </form>
                </div>
        @endcan
    </div>

</div>