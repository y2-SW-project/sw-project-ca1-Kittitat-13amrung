@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Welcome</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Welcome to Carshow.

                    Let us take you to our <a href=" {{ route('user.cars.index') }}"> showcase </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
