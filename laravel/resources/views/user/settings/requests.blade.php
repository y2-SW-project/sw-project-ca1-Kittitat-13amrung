@extends('layouts.app')

@section('content')
<div class="container intro mt-5">
    @include('layouts.profile')

    {{-- show list of artists --}}
    <section class="col-lg-8 border bg-light">
        @if (count($requests) == 0) 
        <h4 class="text-center mt-5">You have not yet post any request...</h4>
        @else
        <div class="col-lg-12">

            @each('templates.request-card', $requests, 'commission')

            
</div>
        @endif
    </section>
</div>

@include('layouts.footer')

@endsection