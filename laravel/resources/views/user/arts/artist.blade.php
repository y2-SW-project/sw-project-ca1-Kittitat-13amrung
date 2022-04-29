@extends('layouts.app')

@section('content')
    <script src="{{ asset('js/artists.js') }}"></script>
    <main class="container intro mt-5">
        <div class="row">
            <div class="display-5 text-center my-5">
                <i class="me-3 bi bi-cart-plus"></i>
                <span class="text-uppercase pt-1">
                    {{ __('Artists At Your Service') }}
                </span>
            </div>
        </div>
        <div class="row">
    {{-- yet to be implemented sorting system --}}
        </div>
        {{-- <div class="d-flex justify-content-end ms-3 mb-5">
            <div class="col-lg-3">
                <div class="form-floating">
                    <select class="form-select bg-primary text-white" id="sorting" aria-label="Sort by">
                      <option selected>Newest</option>
                      <option value="1">Oldest</option>
                      <option value="2">Alphabetical</option>
                      <option value="4">Low to High Price</option>
                      <option value="3">High to Low Price</option>
                    </select>
                    <label for="sorting" class="text-light">
                        Sort by:</label>
                  </div>
            </div>
        </div> --}}

        <div class="row">
            @each('templates.artist-caroussel', $artists, 'artist')

            <div class="d-flex justify-content-center">
                {!! $artists->links() !!}
            </div>

            @include('layouts.footer')
        </div>
    @endsection
