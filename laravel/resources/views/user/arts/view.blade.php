@extends ('layouts.app')

@section('content')
    <main class="container intro">
        <script src="{{ asset('js/artistShow.js') }}" defer></script>
        <div class="row">
            <div class="col-lg-7">
                <input type="hidden" name="view" id="view" value="{{ $artist->description }}">
                <div id="viewer"></div>
            </div>

            <div class="col-lg-4 sticky-top h-25 artist">
                <img src="{{ asset('storage/profile/'.$artist->users->image) }}" alt="" class="img-fluid">
                <h4>{{ $artist->users->name }}</h4>
                <p></p>
                <p>
                    @if (Cache::has('user-is-online-' . $artist->users->id))
                    <span class="text-success">Online</span>
                @else
                    <span class="text-secondary">Offline</span>
                @endif
                </p>
            </div>
        </div>
    </main>
@endsection
