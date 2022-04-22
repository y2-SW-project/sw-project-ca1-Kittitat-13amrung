@extends('layouts.app')

@section('content')
    <div class="container mt-5 intro">
        {{-- {{dd($users)}} --}}
        <table class="table table-primary table-striped table-hover">
            
            <tr class="table-dark h4 paragraph">
                <th class="">ID</th>
                <th>Img</th>
                <th>Username</th>
                <th>Email Address</th>
                <th>Last Seen</th>
                <th>Account Active</th>
                <th colspan="2"></th>
            </tr>
           
            @foreach ($users as $user)
            <tr class="paragraph h5 m-3 table-primary">
                    <td class="">
                        {{$user->id}}
                    </td>
                    <td class="col-1">
                        @if ($user->image)
                        <img class="profile-img w-100 rounded-circle " draggable="false"
                            src="{{ asset('/storage/profile/' . $user->image . '.jpg') }}"
                            alt="profile_image">
                        @else
                            <img class="img-fluid w-100"
                                src="{{ asset('/storage/image/person-circle.svg') }}" draggable="false" alt="profile_image">
                        @endif
                    </td>
                    <td>
                        {{$user->name}}
                    </td>
                    <td>
                        {{$user->email}}
                    </td>
                    <td>
                        {{-- {{$user->days}} --}}
                    </td>
                    <td>
                        {{-- Since {{$user->active}} --}}
                    </td>
                    <td>
                        <div class="justify-content-around">
                            <a href="" class="btn btn-primary px-5">Edit</a>
                            <a href="" class="btn btn-primary px-5">Delete</a>
                        </div>
                    </td>
                    <td>

                    </td>
                </tr>
                @endforeach
        </table>

        
    </div>
    
    <div class="d-flex justify-content-center my-5">
        {!! $users->links() !!}
    </div>
    @include('layouts.footer')
@endsection