<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Artist;
use App\Models\Request as Commission;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->authorize('admin');

        $users = new User();
        $queries = [];

        $filterColumns = [
            'email',
            'id'
        ];

        foreach ($filterColumns as $filterColumn) {
            if (request()->has($filterColumn)) {
                $users = $users->where($filterColumn, request($filterColumn));
                $queries[$filterColumn] = request($filterColumn);

                if($filterColumn == 'email') {
                    $users = DB::table('users')->where('email', 'LIKE', '%'.request($filterColumn).'%');

                    // $users = $users->where('id', $query->id);

                    // dd($user);


                }
            } 
        }

        if(request()->has('sort')) {
            // $users = $users->orderBy('')
        }

        $users = $users->paginate(20)->appends($queries);

        // dd($users[0]->id);

        return view('admin.index', [
            'users' => $users
        ]);
    }

    public function artists()
    {
        $this->authorize('admin');

        $artists = Artist::with('users');
        $queries = [];

        $filterColumns = [
            'status',
            'commercial_use',
            'id'
        ];

        foreach ($filterColumns as $filterColumn) {
            if (request()->has($filterColumn)) {
                $artists = $artists->where($filterColumn, request($filterColumn));
                $queries[$filterColumn] = request($filterColumn);
            } 
        }

        if(request()->has('sort')) {
            // $artists = $artists->orderBy('')
        }

        $artists = $artists->paginate(20)->appends($queries);

        // dd($artists[0]->id);

        return view('admin.arts.artists', [
            'artists' => $artists
        ]);
    }

    public function requests()
    {
        $this->authorize('admin');

        $commissions = Commission::with('users');
        $queries = [];

        $filterColumns = [
            'status',
            'commercial_use',
            'id'
        ];

        foreach ($filterColumns as $filterColumn) {
            if (request()->has($filterColumn)) {
                $commissions = $commissions->where($filterColumn, request($filterColumn));
                $queries[$filterColumn] = request($filterColumn);
            } 
        }

        if(request()->has('sort')) {
            // $commissions = $commissions->orderBy('')
        }

        $commissions = $commissions->paginate(20)->appends($queries);

        // dd($commissions[0]->id);

        return view('admin.arts.requests', [
            'commissions' => $commissions
        ]);
    }

    public function deleteUser($id)
    {
        $this->authorize('admin');

        $user = User::findOrFail($id);
        


        $user->delete();

        return redirect()->route('admin.index');
    }

    public function deleteArtist($id)
    {
        $this->authorize('admin');

        $artist = Artist::findOrFail($id);
        


        $artist->delete();

        return redirect()->route('admin.artists');
    }
}
