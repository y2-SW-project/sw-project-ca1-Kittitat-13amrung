@extends('layouts.app')

@section('content')
    <div class="container mt-5 intro">

        {{-- <a href="{{route('admin.artists', [])}}">Comm</a> --}}
        {{-- {{dd($artists)}} --}}
        <table class="table table-primary table-striped table-hover">
            
            <tr class="table-dark h4 paragraph">
                <th class="">ID</th>
                <th>Img</th>
                <th>Artist Name</th>
                <th class="text-start">Takes</th>
                <th class="text-center">Last Seen</th>
                <th class="text-center">Status</th>
                <th colspan="3"></th>
            </tr>
           
            @foreach ($artists as $artist)
            <tr class="paragraph h5 m-3 table-primary">
                    <td class="">
                        {{$artist->id}}
                    </td>
                    <td class="col-1">
                        @if ($artist->users->image)
                        <img class="profile-img w-100 rounded-circle " draggable="false"
                            src="{{ asset('/storage/profile/' . $artist->users->image . '.jpg') }}"
                            alt="profile_image">
                        @else
                            <img class="img-fluid w-100"
                                src="{{ asset('/storage/image/person-circle.svg') }}" draggable="false" alt="profile_image">
                        @endif
                    </td>
                    <td>
                        {{$artist->users->name}}
                    </td>
                    <td class="">
                        @if ($artist->commercial_use == 1)
                        Commercial Use
                        @else 
                        Personal Use
                        @endif
                    </td>
                    <td class="text-center">
                        @if ($artist->users->days)
                        {{$artist->users->days}}
                        @else
                        <span class="text-dark text-opacity-50">
                            Offline
                        </span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if ($artist->status == 1)
                        <span class="text-success text-opacity-75">Available</span>
                        @else 
                        <span class="text-danger text-opacity-75">Unavailable</span>
                        @endif
                    </td>
                    <td>
                        {{-- Since {{$artist->active}} --}}
                    </td>
                    <td>
                        <div class="text-center">
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
        {!! $artists->links() !!}
    </div>
    @include('layouts.footer')
@endsection