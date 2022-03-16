@extends ('layouts.app')

@section ('content')
    <main class="container">
        <div class="row">
            <div class="col-lg-12">
                {{ $request->start_price }}
            </div>
        </div>
    </main>
@endsection