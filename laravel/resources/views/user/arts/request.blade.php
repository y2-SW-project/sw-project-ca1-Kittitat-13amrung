@extends ('layouts.app')
<script src="{{ asset('js/request.js') }}" defer></script>

@section('content')

    <main class="container intro">
        <div class="mt-5 d-flex justify-content-around">
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

        <div class="d-flex">

            <div class="requests">

                
                <div class="col-lg-12 col-12">
                    @each('templates.request-card', $commissions, 'commission')
                </div>

            </div>

            <div class="position-relative col-lg-8 my-5">

                <div class="filter-sticky ms-3 mb-2">
                    {{-- <div class="ms-auto mb-5 col-lg-3">
                        <div class="form-floating">
                            <select class="form-select bg-primary text-white" id="sorting" aria-label="Sort by">
                              <option selected>Newest</option>
                              <option value="1">Oldest</option>
                              <option value="2">Earliest Deadline</option>
                              <option value="3">Latest Deadline</option>
                            </select>
                            <label for="sorting" class="text-light">Sort by:</label>
                          </div>
                    </div> --}}

                <div class="p-5 request-show border-end border-bottom border-3 ms-3 rounded rounded-5 bg-light"
                    id="req-detail">
                    
                    <div class="tags d-flex">
                        <div class="my-5 pe-5 mx-1 me-auto text-start" id="commTag"></div>
                        <div class="my-5 pe-5 mx-2 ms-auto text-white text-end" id="artTag"></div>
                    </div>
                    <div id="requestTitle">
                    </div>
                    <div class="request-select px-auto" id="requestBody">
                    </div>
                </div>
            </div>
            </div>
            {{-- {{ dd(Auth::user()->hasRole('admin')) }} --}}
        </div>
    </main>

    @include('layouts.footer')
@endsection
