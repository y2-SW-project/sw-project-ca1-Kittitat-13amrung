@extends('layouts.app')

@section('content')
    <div class="container mt-5 intro">
        {{-- {{dd($commissions)}} --}}
        <table class="table table-primary table-striped table-hover">
            
            <tr class="table-dark h4 paragraph">
                <th class="">ID</th>
                <th>Img</th>
                <th>Title</th>
                <th>Email Address</th>
                <th>Last Seen</th>
                <th>Account Active</th>
                <th colspan="2"></th>
            </tr>
           
            @foreach ($commissions as $commission)
            <tr class="paragraph h5 m-3 table-primary">
                    <td class="">
                        {{$commission->id}}
                    </td>
                    <td class="col-1">
                        @if ($commission->users->img)
                        <img class="profile-img w-100 rounded-circle " draggable="false"
                            src="{{ asset('/storage/profile/' . $commission->image . '.jpg') }}"
                            alt="profile_image">
                        @else
                            <img class="img-fluid w-100"
                                src="{{ asset('/storage/image/person-circle.svg') }}" draggable="false" alt="profile_image">
                        @endif
                    </td>
                    <td>
                        {{$commission->title}}
                    </td>
                    <td>
                        {{$commission->email}}
                    </td>
                    <td>
                        {{-- {{$commission->days}} --}}
                    </td>
                    <td>
                        {{-- Since {{$commission->active}} --}}
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
        {!! $commissions->links() !!}
    </div>
    @include('layouts.footer')
@endsection