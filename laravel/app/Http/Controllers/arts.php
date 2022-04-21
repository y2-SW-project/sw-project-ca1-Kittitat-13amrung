<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Artist;
use Likeable;
use Auth;

class arts extends Controller
{
    // use auth to secure session and ensuring 
    // that users are routed to their respective role's index page 
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        // authentication
        $user = Auth::user();

        $index = 'index'; // declaring a local variable

        if($user && $user->hasRole('admin')) {
            $index = 'admin.index'; //if so route to admin page
        }
        

        //get all from the Car Table
        // $artists = DB::select('SELECT * FROM artists LIMIT 6');

        $popArtists = Artist::limit(6)->withCount('likers')->orderBy('likers_count', 'desc')->get();
        // dd($popArtists);
        $newArtists = Artist::with('users')->orderBy('created_at', 'asc')->paginate(6);

        $getRecents = "";

        if (session()->has('recentSearch.artists')){
            // for ($i = count(session('recentSearch')) - 1; $i >= 0; $i--) {
                $recents = session('recentSearch.artists');
                foreach ($recents as $recent) {

                    $tempArray[] = Artist::with('users')->where('id', $recent)->distinct()->get()->first();
                    $getRecent = collect($tempArray);

                }

                // $getRecent->make();
                // dd($recents->unique());
            //     $recents[] = Artist::with('users')->where('user_id', $recent)->get()->makeHidden('description');
            //     // $recents->reverse();
            //     dd($recents);
            // } 
            $getRecents = $getRecent->reverse()->take(3);    
            // dd(session('recentSearch'));
                // $getRecent->get();
            // $recents->makeHidden('description');
        }

        // dd(session('recentSearch'));

        // dd($getRecent->reverse()->take(3));

        return view($index, [
            //the data receive from Car::all will
            // be assigned to 'cars'
            'popArtists' => $popArtists,
            'newArtists' => $newArtists,
            'recents' => $getRecents
        ]);
    }
}