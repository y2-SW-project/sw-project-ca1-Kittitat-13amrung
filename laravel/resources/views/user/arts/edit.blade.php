@extends('layouts.app')
@section('content')
    <script src="{{ asset('js/createRequest.js') }}" defer></script>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 my-5">
                <div class="card">
                    <div class="card-header">
                        Create A Request
                    </div>
                    <div class="card-body">
                        <!-- this block is ran if the validation code in the controller fails
                                                                                                                                                          this code looks after displaying the correct error message to the user -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('arts.requests.update', $req->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group my-4">
                                <label for="title">Title</label>
                                <input type="text" class="form-control paragraph h6" id="title" name="title"
                                    value="{{ old('title', $req->title) }}" />
                            </div>

                            <div class="form-group my-4">
                                <label for="art_genre">Genre</label>
                                <div class="form-check form-switch">
                                    <label class="form-check-label paragraph h6" for="traditional_art">Traditional
                                        Art</label>
                                    <input class="form-check-input" name="traditional_art" type="checkbox"
                                        id="traditional_art" value="{{ old('traditional_art', $req->traditional_art) }}"
                                        {{ old('traditional_art', $req->traditional_art) == 1 ? ' checked' : '' }}>
                                </div>
                                <div class="form-check form-switch">
                                    <label class="form-check-label paragraph h6" for="digital_art">Digital Art</label>
                                    <input class="form-check-input" name="digital_art" type="checkbox" id="digital_art"
                                        value="{{ old('digital_art', $req->digital_art) }}"
                                        {{ old('digital_art', $req->digital_art) == 1 ? ' checked' : '' }}>
                                </div>
                                <div class="form-check form-switch">
                                    <label class="form-check-label paragraph h6" for="pixel_art">Pixel Art</label>
                                    <input class="form-check-input" name="pixel_art" type="checkbox" id="pixel_art"
                                        {{ old('pixel_art', $req->pixel_art) == 1 ? ' checked' : '' }}>
                                </div>
                            </div>

                            <label for="comm_use">For Commerical Purposes?</label>
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="radio" name="commercial_use" id="commercial_use1"
                                    value="true" {{ old('commercial_use', $req->commercial_use) == 1 ? ' checked' : '' }}>
                                <label class="form-check-label paragraph h6" for="commercial_use1">
                                    Yes
                                </label>
                            </div>
                            <div class="form-check my-3">
                                <input class="form-check-input" type="radio" name="commercial_use" id="commercial_use0"
                                    value="false"
                                    {{ old('commercial_use', $req->commercial_use) == 0 ? ' checked' : '' }}>
                                <label class="form-check-label paragraph h6" for="commercial_use0">
                                    No
                                </label>
                            </div>


                            <div id="request" class="bg-white">
                            </div>
                            <input type="hidden" name="request1" id="request1">
                            <input type="hidden" name="request2" id="request2"
                                value="{{ old('request1', $req->description) }}">

                            <div class="form-group my-5 d-flex">
                                <label for="start_date" class="px-2">Starting Date:</label>
                                <input type="date" class="form-control paragraph h6" id="start_date" name="start_date"
                                    value="{{ old('start_date', $req->start_date) }}" />

                                <label for="end_date" class="px-2">Deadline Date:</label>
                                <input type="date" class="form-control paragraph h6" id="end_date" name="end_date"
                                    value="{{ old('end_date', $req->end_date) }}" />
                            </div>

                            <div class="form-group my-5 d-flex">
                                <label for="start_price">Minimum Price</label>
                                <input type="number" class="form-control paragraph h6" id="start_price" name="start_price"
                                    value="{{ old('start_price', $req->start_price) }}" />

                                <label for="end_price">Maximum Price</label>
                                <input type="number" class="form-control paragraph h6" id="end_price" name="end_price"
                                    value="{{ old('end_price', $req->end_price) }}" />
                            </div>

                            <a href="{{ route('arts.requests') }}" class="btn btn-outline">Cancel</a>
                            <button type="submit" id="request-submit" class="btn btn-primary float-right">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
