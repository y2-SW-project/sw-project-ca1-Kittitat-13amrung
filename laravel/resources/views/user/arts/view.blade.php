@extends ('layouts.app')

@section('content')
    <main class="container">
        <script src="{{ asset('js/artistShow.js') }}" defer></script>
        <div class="row">
            <div class="col-lg-12">
                <input type="hidden" name="view" id="view" value="{{ $artist->description }}">
                <div id="viewer"></div>

                @if (Cache::has('user-is-online-' . $artist->users->id))
                    <span class="text-success">Online</span>
                @else
                    <span class="text-secondary">Offline</span>
                @endif
            </div>
        </div>
    </main>
@endsection
