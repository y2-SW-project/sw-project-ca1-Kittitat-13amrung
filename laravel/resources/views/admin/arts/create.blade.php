@extends('layouts.app')

@section ('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 my-5">
        <div class="card">
          <div class="card-header">
            Create A Request
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
            <form method="POST" action="{{ route('arts.requests.store') }}" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="{{  csrf_token()  }}">

              <div class="form-group my-4">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" />
              </div>

              <div class="form-group my-4">
                  <label for="art_genre">Genre</label>
                  <div class="form-check form-switch">
                      <label class="form-check-label" for="traditional_art">Traditional Art</label>
                    <input class="form-check-input"  name="traditional_art" type="checkbox" id="traditional_art">
                  </div>
                  <div class="form-check form-switch">
                      <label class="form-check-label" for="digital_art">Digital Art</label>
                    <input class="form-check-input" name="digital_art" type="checkbox" id="digital_art">
                  </div>
                  <div class="form-check form-switch">
                      <label class="form-check-label" for="pixel_art">Pixel Art</label>
                    <input class="form-check-input" name="pixel_art" type="checkbox" id="pixel_art">
                  </div>
              </div>

              <label for="comm_use">For Commerical Purposes?</label>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="commercial_use" id="commercial_use1" value="true">
                <label class="form-check-label" for="commercial_use1">
                    Yes
                </label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="radio" name="commercial_use" id="commercial_use0" value="false">
                <label class="form-check-label" for="commercial_use0">
                    No
                </label>
                </div>

              <div class="form-group my-4 d-flex">
                <label for="start_date" class="px-2">Starting Date:</label>
                <input type="date" class="form-control m-2" id="start_date" name="start_date" value="{{old('start_date')}}"/>

                <label for="end_date" class="px-2">Deadline Date:</label>
                <input type="date" class="form-control m-2" id="end_date" name="end_date" value="{{old('end_date')}}"/>
              </div>

              <div class="form-group my-4 d-flex">
                <label for="start_price">Minimum Price</label>
                <input type="number" class="form-control m-2" id="start_price" name="start_price" value="{{old('start_price')}}"/>

                <label for="end_price">Maximum Price</label>
                <input type="number" class="form-control m-2" id="end_price" name="end_price" value="{{old('end_price')}}"/>
              </div>

              <a href="{{ route('arts.requests') }}" class="btn btn-outline">Cancel</a>
              <button type="submit" class="btn btn-primary float-right">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
