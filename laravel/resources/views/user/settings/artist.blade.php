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

                {{-- <label for="commercial_use">Accept Commission For Commercial Purposes?</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="commercial_use" id="commercial_use1" value="1"
                        {{ is_array(old('commercial_use')) && in_array(1, old('commercial_use', $artist->commercial_use))? ' checked': '' }}>
                    <label class="form-check-label" for="commercial_use1">
                        Yes
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="commercial_use" id="commercial_use0" value="0"
                        {{ is_array(old('commercial_use')) && in_array(0, old('commercial_use', $artist->commercial_use))? ' checked': '' }}>
                    <label class="form-check-label" for="commercial_use0">
                        No
                    </label>
                </div> --}}
                {{-- {{ dd($artist->status) }} --}}
                <label for="status">Your Current Status:</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="status1" value="1"
                        {{ is_array(old('status')) && in_array('1', old('status', $artist->status)) ? ' checked' : '' }}>
                    <label class="form-check-label" for="status1">
                        Available
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="status0" value="0"
                        {{ is_array(old('status')) && in_array('0', old('status', $artist->status)) ? ' checked' : '' }}>
                    <label class="form-check-label" for="status0">
                        Unavailable
                    </label>
                </div>

                <div class="form-group d-flex">
                    <label class="" for="duration">Duration per Commission:</label>
                    <input type="number" step="1" class="form-control form-control-sm" id="duration" name="duration"
                        value="{{ old('duration', $artist->duration) }}">
                </div>

                <div class="form-group my-4 d-flex">
                    <label for="start_price">Minimum Price:</label>
                    <input type="number" class="form-control m-2" id="start_price" name="start_price"
                        value="{{ old('start_price', $artist->start_price) }}" />

                    <label for="end_price">Maximum Price:</label>
                    <input type="number" class="form-control m-2" id="end_price" name="end_price"
                        value="{{ old('end_price', $artist->end_price) }}" />
                </div>

                <div id="editor" class="bg-white">
                </div>
                <input type="hidden" name="editor1" id="editor1">
                <input type="hidden" name="editor2" id="editor2" value="{{ $artist->description }}">

                <button type="submit" id="submit" class="my-5 btn btn-primary float-right">Submit</button>
            </form>

            <p id="test"></p>

        </div>
    </div>
@endsection
