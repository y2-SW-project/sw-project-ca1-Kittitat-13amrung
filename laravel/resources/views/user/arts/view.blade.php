@extends ('layouts.app')

@section('content')
    <main class="container">
        <script src="{{ asset('js/artistShow.js') }}" defer></script>
        <div class="row">
            <div class="col-lg-12">
                <input type="hidden" name="view" id="view" value="{{ $artist->description }}">
                <div id="viewer"></div>
            </div>
        </div>
    </main>
@endsection
