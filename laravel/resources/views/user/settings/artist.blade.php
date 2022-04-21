<script src="{{ asset('js/artistProfile.js') }}" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js" defer></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">
@extends ('layouts.app')
@section('content')
    <div class="container my-5 pt-5">
        <div class="display-6 ms-4 pt-5">
            <i class="display-4 bi bi-person-circle"></i>
            {{ __('Artist Profile') }}
        </div>
    @include('layouts.profile')
    <div class="border px-5 bg-white">

        <div class="col-lg-12 mt-5">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session()->get('message'))
            <div class="alert alert-success" role="alert">
                <strong>Success: </strong>{{ session()->get('message') }}
            </div>
        @endif
    </div>
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div id="dropzone-err"></div>
    <div class="modal fade" id="modal-profile" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content bg-primary">
            <div class="modal-header">
              <h5 class="modal-title text-capitalize" id="modalLabel">Crop your User Profile</h5>
              <a href="#" class="fs-4 nav-link text-dark">
                <span data-bs-dismiss="modal" aria-hidden="true">&times;</span>
              </a>
            </div>
            <div class="modal-body">
              <div class="h-100">
                <img class="img-fluid" src="{{asset('storage/portfolio/1.jpg')}}" id="image">
              </div>
            </div>
            <div class="modal-footer">
              <a href="#" class="btn btn-light" data-dismiss="modal">Cancel</a>
              <button type="button" class="btn btn-primary" id="crop">Crop</button>
            </div>
          </div>
        </div>
      </div>
    <form action="{{route('artist.upload.file')}}" class="dropzone" id="artist-profile" enctype="multipart/form-data">
        @csrf
        <div class="fallback">

        </div>

    </form>

            <form action="{{ route('artist.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <label for="commercial_use">Accept Commission For Commercial Purposes?</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="commercial_use" id="commercial_use1" value="1"
                        {{ old('commercial_use', $artist->commercial_use) == 1 ? ' checked' : '' }}>
                    <label class="form-check-label" for="commercial_use1">
                        Yes
                    </label>
                    {{-- {{ dd(old('commercial_use', $artist->commercial_use)) }} --}}
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="commercial_use" id="commercial_use0" value="0"
                        {{ old('commercial_use', $artist->commercial_use) == 0 ? ' checked' : '' }}>
                    <label class="form-check-label" for="commercial_use0">
                        No
                    </label>
                </div>
                {{-- {{ dd($artist->status) }} --}}
                <label for="status">Your Current Status:</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="status1" value="1"
                        {{ old('status', $artist->status) == 1 ? ' checked' : '' }}>
                    <label class="form-check-label" for="status1">
                        Available
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="status0" value="0"
                        {{ old('status', $artist->status) == 0 ? ' checked' : '' }}>
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

                <button type="submit" id="submit-all" class="my-5 btn btn-primary float-right">Submit</button>
            </form>

            <p id="test"></p>

        </div>
    </div>

</div>
@include('layouts.footer')
@endsection
