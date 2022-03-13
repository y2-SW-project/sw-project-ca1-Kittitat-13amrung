@extends ('layouts.app')

@section ('content')
<main class="container mt-5">
    <div class="row">
        <div class="display-4">
            <i class="display-2 bi bi-person-circle"></i>
            {{ __('Your Profile')}}
        </div>
    </div>

    <div class="row mt-5">
        <div class="">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
            @foreach($errors->all() as $error)
            <li>
                {{$error}}
            </li>
            @endforeach
            </ul>
        </div>
        @endif
        @if(session()->get('message'))
        <div class="alert alert-success" role="alert">
            <strong>Success: </strong>{{session()->get('message')}}
        </div>
        @endif
        </div>
        <div class="col-lg-4 text-center profile rounded rounded-3">
            <br>

            @if(Auth::user()->image)
                <img class="img-fluid w-50 rounded-circle" src="{{asset('/storage/profile/'.Auth::user()->image)}}" alt="profile_image">
            @endif

            <h2 class="display-6">
                {{ Auth::user()->name}}
            </h2>

            <br>

            <ul class="navbar-nav fs-2">
                                        
                <a href="{{ url('/') }}" class="nav-link nav-size text-dark">
                                        <li class="navbar-item nav-menu py-4">
                                                {{ __('Account Information') }}
                                            </li>
                                        </a>
                                        
                                        <a href="#" class="nav-link nav-size text-dark">
                                        <li class="navbar-item nav-menu py-4">
                                                {{ __('Commissions') }}
                                            </li>
                                        </a>
                                        <a href="{{ url('/') }}" class="nav-link nav-size text-dark">
                                        <li class="navbar-item nav-menu py-4">
                                                {{ __('Notifications') }}
                                            </li>
                                        </a>


                                        <a href="{{ url('/') }}" class="nav-link nav-size text-dark">
                                        <li class="navbar-item nav-menu py-4">
                                                {{ __('Appearances') }}
                                            </li>
                                        </a>

                                        <a href="{{ url('/') }}" class="nav-link nav-size text-dark">
                                        <li class="navbar-item nav-menu py-4">
                                                {{ __('Privacy') }}
                                            </li>
                                        </a>

                                            <a class="nav-link nav-size text-dark" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                        <li class="navbar-item nav-menu py-4">
                                            {{ __('Logout') }}
                                            
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </li>
                                    </a>
                                    </ul>
        </div>

        <div class="col-lg-8 profile">
            <div class="col-lg-12">
                <div class="d-flex col-lg-6">
                    <div class="col-lg-1 me-5">
                        <br>
                    </div>
                    <div class="col-lg-9">
                        @if(Auth::user()->image)
                            <img class="img-fluid rounded-2" src="{{asset('/storage/profile/'.Auth::user()->image)}}" alt="profile_image">
                            @endif
                    </div>
                        <div class="col-lg-12">

                    <div class="mx-5">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            @if($message = Session::get('success'))
                            <div class="alert alert-success">
                        <p>{{$message}}</p>
                            </div>
                        @endif
                            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <input type="file" id="image" name="image">
                            </div>
                            <div class="mb-3">
                                <label class="fs-4 mb-2" for="name"><strong>Username:</strong></label>
                                <input type="text" class="form-control form-control-lg" id ="name" name="name" value="{{Auth::user()->name}}">
                            </div>
                                <div class="mb-3">
                                <label class="fs-4 mb-2" for="email"><strong>Email-Address:</strong></label>
                                <input type="text" class="form-control form-control-lg" id ="email" value="{{Auth::user()->email}}" name="email">
                            </div>
                            <div class="">
                            <label class="fs-4" for="oldPassword"><strong>Verify Old Password:</strong></label>
                            <input type="password" class="form-control form-control-lg" id ="oldPassword" value="" name="oldPassword">
                            </div>
                            <div class="">
                            <label class="fs-4" for="newPassword"><strong>New Password:</strong></label>
                            <input type="password" class="form-control form-control-lg" id ="newPassword" value="" name="newPassword">
                            </div>
                            </div>

                        </div>
                    </div>
                    <hr>
                    <div class="col-lg-12">
                    <div class="mb-3">
                                <label class="fs-4 mb-2" for="email"><strong>Email-Address:</strong></label>
                                <input type="text" class="form-control form-control-lg" id ="email" value="{{Auth::user()->email}}" name="email">
                            </div>
                            <div class="">
                            <label class="fs-4" for="oldPassword"><strong>Verify Old Password:</strong></label>
                            <input type="password" class="form-control form-control-lg" id ="oldPassword" value="" name="oldPassword">
                            </div>
                            <div class="">
                            <label class="fs-4" for="newPassword"><strong>New Password:</strong></label>
                            <input type="password" class="form-control form-control-lg" id ="newPassword" value="" name="newPassword">
                            </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Update Profile</button>
                    </div>
                </div>
                </form>

                
        </div>
    </div>
</main>
@endsection