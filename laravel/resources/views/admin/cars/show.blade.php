@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    <div class="col-md-2"></div>
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <div class="card-header"><br></div>

                <div class="card-body">
                        <table id="table-cars" class="table table-hover">
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-10">
                                    <img class="w-75 justify-content-center" src="/storage/image/{{ $car->image_location }}" alt="{{ $car->make . " " . $car->model }}">
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                            <tbody>
                                <br>
                                <td>Make</td>
                                    <td>{{ $car->make }}</td>
                                </tr>
                                <tr>
                                    <td>Model</td>
                                    <td>{{ $car->model }}</td>
                                </tr>
                                <tr>
                                    <td>Price</td>
                                    <td>€{{ $car->price }}</td>
                                </tr>
                                <tr>
                                    <td>Engine Size</td>
                                    <td>{{ $car->engine_size }} Litres</td>
                                </tr>
                            </tbody>
                        </table>

                        <a href="{{ route('admin.cars.index') }}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
