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

        // Sessions
        $popArtists = Artist::limit(6)->withCount('likers')->orderBy('likers_count', 'desc')->get();

        $newArtists = Artist::with('users')->orderBy('created_at', 'desc')->paginate(6); 

        $getRecents = "";

        if (session()->has('recentSearch.artists')){
                $recents = session('recentSearch.artists');
                foreach ($recents as $recent) {
                    $tempArray[] = Artist::with('users')->where('id', $recent)->get()->first();
                    $getRecent = collect($tempArray);
                }

            $getRecents = $getRecent->unique('id')->reverse()->take(3)->filter();    

        }

        // dd($recents->collect());

        // dd($getRecents);

        return view($index, [
            'popArtists' => $popArtists,
            'newArtists' => $newArtists,
            'recents' => $getRecents
        ]);
    }
}