@extends ('layouts.app')
@section('content')
    <script src="{{ asset('js/request.js') }}" defer></script>
    @include('layouts.profile')
    <div class="profile">
        <div class="display-6 pt-5">
            <i class="display-4 bi bi-person-circle"></i>
            {{ __('Artist Profile') }}
            <hr>
        </div>

        <div class="col-lg-12 mt-5">

            <form action="/file-upload" class="dropzone" id="user-profile" enctype="multipart/form-data">
                @csrf
            </form>

            <form action="{{ route('artist.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <label for="commercial_use">Accept Commission For Commerical Purposes?</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="commercial_use" id="commercial_use1" value="true">
                    <label class="form-check-label" for="commercial_use1">
                        Yes
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="commercial_use" id="commercial_use0" value="false">
                    <label class="form-check-label" for="commercial_use0">
                        No
                    </label>
                </div>

                <div class="form-group my-4 d-flex">
                    <label for="start_date" class="">Starting Date:</label>
                    <input type="date" class="form-control m-2" id="start_date" name="start_date"
                        value="{{ old('start_date') }}" />

                    <label for="end_date" class="">Deadline Date:</label>
                    <input type="date" class="form-control m-2" id="end_date" name="end_date"
                        value="{{ old('end_date') }}" />
                </div>

                <div class="form-group my-4 d-flex">
                    <label for="start_price">Minimum Price:</label>
                    <input type="number" class="form-control m-2" id="start_price" name="start_price"
                        value="{{ old('start_price') }}" />

                    <label for="end_price">Maximum Price:</label>
                    <input type="number" class="form-control m-2" id="end_price" name="end_price"
                        value="{{ old('end_price') }}" />
                </div>

                <div id="editor" class="bg-white">
                </div>
                <input type="hidden" name="editor1" id="editor1">

                <button type="submit" id="submit" class="my-5 btn btn-primary float-right">Submit</button>
            </form>

        </div>
    </div>
@endsection
