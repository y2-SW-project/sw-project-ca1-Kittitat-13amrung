@extends('layouts.app')

@section ('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
             <div class="row">
               <div class="col-md-11">
                 Cars 
               </div>
               <div class="col-md-1">
                 <a href="{{ route('admin.cars.create') }}" class="btn btn-primary justify-content-end">Add</a>
               </div>
             </div>
          </div>
          <div class="card-body">
            @if (count($cars)=== 0)
              <p>There are no Cars!</p>
            @else
            <table id="table-cars" class="table table-hover">
                <thead>
                  <th>ID</th>
                  <th>Image</th>
                  <th>Make</th>
                  <th>Model</th>
                  <th>Price</th>
                  <th>Engine Size</th>
                </thead>
                <tbody>
                  @foreach ($cars as $car)
                    <tr data-id="{{ $car->id }}">
                      <td>{{ $car->id }}</td>
                      <td>
                        <img src="{{ $storagePaths }}{{ $car->image_location }}" alt="test" width="50px">
                      </td>
                      <td>{{ $car->make }}</td>
                      <td>{{ $car->model }}</td>
                      <td>{{ $car->price }}</td>
                      <td>{{ $car->engine_size }}</td>
                      <td>
                        <a href="{{ route('admin.cars.show', $car->id) }}" class="btn btn-primary">View</a>
                        <a href="{{ route('admin.cars.edit', $car->id) }}" class="btn btn-warning">Edit</a>
                        <form style="display:inline-block" method="POST" action="{{ route('admin.cars.destroy', $car->id) }}">
                          <input type="hidden" name="_method" value="DELETE">
                          <input type="hidden" name="_token"  value="{{ csrf_token() }}">
                          <button type="submit" class="form-cotrol btn btn-danger">Delete</a>
                      </td>
                  @endforeach
                </tbody>
              </table>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
