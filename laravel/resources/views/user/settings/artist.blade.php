<meta name="csrf-token" content="{{ csrf_token() }}">
@extends ('layouts.app')
@section('content')
    @include('layouts.profile')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="container">
        <div class="row text-center">
            <div class="display-6">
                <i class="display-4 bi bi-person-circle"></i>
                {{ __('Artist Profile') }}
            </div>
        </div>

        <form action="/file-upload" class="dropzone" id="my-form" enctype="multipart/form-data">
            @csrf
        </form>

    </div>
@endsection
