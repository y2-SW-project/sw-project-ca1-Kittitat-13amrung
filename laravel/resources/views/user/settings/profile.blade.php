@extends ('layouts.app')

@section ('content')
<main class="container mt-5">
    <div class="row">
        <div class="col-lg-12 display-5">
            <i class="bi bi-person-circle"></i>
            {{ __('Profile')}}
        </div>
    </div>

    <div class="row mt-5">
        <div class="border border-1  col-lg-4 text-center profile rounded rounded-3">
            <br>

            @if(Auth::user()->image)
                <img class="img-fluid w-50 rounded-circle" src="{{asset('/storage/image/'.Auth::user()->image)}}" alt="profile_image">
            @endif

            <h2 class="display-6">
                {{ Auth::user()->name}}
            </h2>

            <br>

            <ul class="navbar-nav fs-2">
                                        
                                        <li class="navbar-item py-4">
                                            <a href="{{ url('/') }}" class="nav-link nav-size text-dark">
                                                {{ __('Account Information') }}
                                            </a>
                                        </li>
                                        
                                        <li class="navbar-item py-4">
                                            <a href="{{ route('user.settings.profile') }}" class="nav-link nav-size text-dark">
                                                {{ __('Commissions') }}
                                            </a>
                                        </li>
                                        <li class="navbar-item py-4">
                                            <a href="{{ url('/') }}" class="nav-link nav-size text-dark">
                                                {{ __('Notifications') }}
                                            </a>
                                        </li>


                                        <li class="navbar-item py-4">
                                            <a href="{{ url('/') }}" class="nav-link nav-size text-dark">
                                                {{ __('Appearances') }}
                                            </a>
                                        </li>

                                        <li class="navbar-item py-4">
                                            <a href="{{ url('/') }}" class="nav-link nav-size text-dark">
                                                {{ __('Privacy') }}
                                            </a>
                                        </li>

                                        <li class="navbar-item py-4">
                                            <a class="nav-link nav-size text-dark" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                        </li>
                                    </ul>
        </div>

        <div class="border border-1 col-lg-7 mx-5 profile">
            <div class="col-lg-4 d-flex">
            @if(Auth::user()->image)
                <img class="rounded-2 img-fluid" src="{{asset('/storage/image/'.Auth::user()->image)}}" alt="profile_image">
                @endif
                <div class="col-lg-3">
                    <h3 class="h3">Username:</h3>
                    <h3 class="h3">Email-Address:</h3>
                    <h3 class="h3">Password:</h3>
                </div>
            </div>

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
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{Auth::user()->name}}'s Profile</div>
                
                <div class="card-body">
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
                    <form action="{{route('user')}}" method="POST">
                    @csrf
                       <div class="form-group">
                           <label for="name"><strong>Name:</strong></label>
                           <input type="text" class="form-control" id ="name" name="name" value="{{Auth::user()->name}}">
                       </div>
                        <div class="form-group">
                           <label for="email"><strong>Email:</strong></label>
                           <input type="text" class="form-control" id ="email" value="{{Auth::user()->email}}" name="email">
                       </div>
                        <button class="btn btn-primary" type="submit">Update Profile</button>
                   </form>
                </div>
            </div>
        </div>
    </div>
                
        </div>
    </div>
</main>
@endsection