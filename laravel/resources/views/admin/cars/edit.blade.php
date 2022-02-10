@extends('layouts.app')

@section ('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="card">
          <div class="card-header">
            Edit Car
          </div>
          <div class="card-body">
          <!-- this block is ran if the validation code in the controller fails
          this code looks after displaying the correct error message to the user -->
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            <form method="POST" action="{{ route('admin.cars.update', $car->id)}}" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="{{  csrf_token()  }}">
              <input type="hidden" name="_method" value="PUT">

              <div class="form-group">
                <label for="make">Make</label>
                <input type="text" class="form-control" id="make" name="make" value="{{ old('make', $car->make) }}" />
              </div>
              <div class="form-group">
                <label for="model">Model</label>
                <input type="text" class="form-control" id="model" name="model" value="{{ old('model', $car->model) }}" />
              </div>
              <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $car->price) }}" />
              </div>
              <div class="form-group">
                <label for="engine_size">Engine Size</label>
                <input type="number" class="form-control" id="engine_size" step="0.1" name="engine_size" value="{{ old('engine_size', $car->engine_size) }}" />
              </div>

              <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" id="file" name="file"/>
              </div>
              
              <br>

              <a href="{{ route('admin.cars.index') }}" class="btn btn-outline">Cancel</a>
              <button type="submit" class="btn btn-primary float-right">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
