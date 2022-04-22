@extends ('layouts.app')
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js" defer></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js" defer></script>
<script src="{{ asset('js/userProfile.js') }}" defer></script>

@section('content')
    <div class="container intro my-5">
        <div class="row">
            <div class="display-6">
                <i class="display-4 bi bi-person-circle"></i>
                {{ __('User Profile') }}
            </div>
        </div>
    @include('layouts.profile')
    <div class="col-lg-7 border">

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session()->get('message'))
        <div class="alert alert-success" role="alert">
            <strong>Success: </strong>{{ session()->get('message') }}
        </div>
    @endif
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
            <div class="col-lg-12 mx-xl-4 mx-lg-1 mx-md-5 mx-5 mt-4 align-self-end ">
                <div class="d-xl-flex d-lg-block col-xl-7 col-lg-12">
                    <div class="col-xl-8 col-lg-12">
                        {{-- <div class="col-lg-12 my-4" class="dropzone" id="user-profile">
                            <label for="image" class="form-label">Upload your profile picture:</label>
                            <input class="form-control" type="file" name="image" id="image">
                        </div> --}}
                        <div class="align-self-center ms-lg-5 ms-xl-0 my-2">
                            <h6 class="h5">Your profile picture:</h6>
                            <div class="progress d-none">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                            </div>
                              <div class="alert user-profile-img" role="alert">
                              </div>
                                <label for="user-profile" class="label" data-toggle="tooltip" title="Change your profile image">
                                    @if (Auth::user()->image)
                                    <img class="rounded-2 img-fluid avatar" src="{{ asset('/storage/profile/' . Auth::user()->image) . '.jpg' }}" id="avatar" alt="avatar">
                                    @else
                                        <img class="rounded-2 img-fluid avatar" id="avatar" alt="avatar" src="https://via.placeholder.com/280">
                                    @endif
                                </label>
                                <input type="file" class="sr-only" id="user-profile" name="file" accept="image/*">
                                <div class="modal fade" id="modal-profile" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content bg-primary">
                                        <div class="modal-header">
                                          <h5 class="modal-title text-capitalize" id="modalLabel">Crop your User Profile</h5>
                                          <a href="#" class="fs-4 nav-link text-dark">
                                            <span data-bs-dismiss="modal" aria-hidden="true">&times;</span>
                                          </a>
                                        </div>
                                        <div class="modal-body">
                                          <div class="h-100">
                                            <img class="img-fluid" src="{{asset('storage/portfolio/1.jpg')}}" id="image">
                                          </div>
                                        </div>
                                        <div class="modal-footer">
                                          <a href="#" class="btn btn-light" data-dismiss="modal">Cancel</a>
                                          <button type="button" class="btn btn-primary" id="crop">Crop</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                
                            </div>
                        </div>

                    <div class="col-xxl-12 col-xl-10 col-lg-12">
                        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                        <div class="mx-auto col-xl-11 col-lg-10 paragraph text-primary">

                                <label class="fs-5" for="name"><strong>Username:</strong></label>
                                <input type="text" class="form-control form-control-md" id="name" name="name"
                                    value="{{ Auth::user()->name }}">
                                <label class="fs-5" for="email"><strong>Email-address:</strong></label>
                                <input type="text" class="form-control form-control-md" id="email"
                                    value="{{ Auth::user()->email }}" name="email">
                                <label class="fs-5" for="oldPassword"><strong>Old
                                        password:</strong></label>
                                <input type="password" class="form-control form-control-md" id="oldPassword" value=""
                                    name="oldPassword">
                                <label class="fs-5" for="password"><strong>New password:</strong></label>
                                <input type="password" class="form-control form-control-md" id="password" value=""
                                    name="password">

                            <label class="fs-5" for="password_confirmation"><strong>Verify New
                                    password:</strong></label>
                            <input type="password" class="form-control form-control-md" id="password_confirmation" value=""
                                name="password_confirmation">
                            </div>
                            <div class="my-3 me-md-5 me-lg-5 me-xl-4 text-end me-sm-5">
                                <button class="btn btn-primary" id="submit" type="submit">Update Profile</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            
            @cannot ('artist')
            <div class="flex-fill col-xxl-12 col-xl-12 col-lg-12 border-top border-dark mt-5 p-5 bg-tertiary text-end">
                
                    <h4 class="h2 text-center text-light py-3 paragraph text-uppercase fw-bold py-5">Wanna take commissions from clients?</h4>
                    <a href="{{ route('user.profile.artist') }}" class="btn btn-lg px-5 py-4 mb-4 btn-dark text-light text-capitalize">Start-up your art career</a>
                {{-- <h6>Role Identifier:</h6>
                @foreach ($tags[0]->roles as $tag)
                    @if ($tag->name == 'user' || $tag->name == 'admin')
                    @else
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="{{ $tag->name }}"
                                id="{{ $tag->name }}" value="{{ $tag->name }}">
                            <label class="form-check-label" for="{{ $tag->name }}">{{ $tag->name }}</label>
                        </div>
                    @endif
                @endforeach
                <br>
                <div class="form-group me-4">
                    <label for="description">Description:</label>
                    <textarea type="text" class="form-control" name="description"
                        value="{{ old('description', Auth::user()->description) }}" rows="10"></textarea>
                </div> --}}

            </div>
            @endcannot
            </div>
    </div>
    </main>
@endsection
