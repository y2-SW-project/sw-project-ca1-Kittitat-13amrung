@extends('layouts.app')

@section('content')
<div class="container intro mt-5">
    @include('layouts.profile')

    <section class="col-lg-8 border bg-light">
        <div class="col-lg-12">

            @each('templates.request-card', $requests, 'commission')

            
</div>
    </section>
</div>

@include('layouts.footer')

@endsection