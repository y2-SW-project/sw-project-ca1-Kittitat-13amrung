@extends ('layouts.app')
<script src="{{ asset('js/userProfile.js') }}" defer></script>
@section('content')
    <div class="container">
        <div class="row">
            <div class="display-6">
                <i class="display-4 bi bi-person-circle"></i>
                {{ __('Artist Profile') }}
            </div>
        </div>
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
    </div>
    @include('layouts.profile')

    <div class="col-lg-7 ps-5 ms-auto profile">
        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-lg-12 mt-4">
                <div class="d-flex  col-lg-7">
                    <div class="col-lg-8">
                        @if (Auth::user()->image)
                            <img class="img-fluid  rounded-2" src="{{ asset('/storage/profile/' . Auth::user()->image) }}"
                                width="235px" alt="profile_image">
                        @else
                            <p class="small text-center">no image</p>
                        @endif
                        <div class="col-lg-12 my-4" class="dropzone" id="user-profile">
                            {{-- <label for="image" class="form-label">Upload your profile picture:</label>
                            <input class="form-control" type="file" name="image" id="image"> --}}
                        </div>
                    </div>
                    <div class="col-lg-12">

                        <div class="mx-3 paragraph">
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
                            <div class="">
                                <label class="fs-4" for="name"><strong>Username:</strong></label>
                                <input type="text" class="form-control form-control-md" id="name" name="name"
                                    value="{{ Auth::user()->name }}">
                            </div>
                            <div class="">
                                <label class="fs-4" for="email"><strong>Email-address:</strong></label>
                                <input type="text" class="form-control form-control-md" id="email"
                                    value="{{ Auth::user()->email }}" name="email">
                            </div>
                            <div class="">
                                <label class="fs-4" for="oldPassword"><strong>Old
                                        password:</strong></label>
                                <input type="password" class="form-control form-control-md" id="oldPassword" value=""
                                    name="oldPassword">
                            </div>
                            <div class="">
                                <label class="fs-4" for="password"><strong>New password:</strong></label>
                                <input type="password" class="form-control form-control-md" id="password" value=""
                                    name="password">
                            </div>

                            <label class="fs-4" for="password_confirmation"><strong>Verify New
                                    password:</strong></label>
                            <input type="password" class="form-control form-control-md" id="password_confirmation" value=""
                                name="password_confirmation">
                        </div>
                    </div>

                </div>
            </div>
            <hr>
            <div class="col-lg-12">
                <h6>Role Identifier:</h6>
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
                </div>

                <div class="my-3 me-4 text-end">
                    <button class="btn btn-primary" id="submit" type="submit">Update Profile</button>
                </div>
            </div>
        </form>


    </div>
    </main>
@endsection
