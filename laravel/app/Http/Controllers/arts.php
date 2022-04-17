<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Artist;
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
        // $user = Auth::user();
        $home = 'index'; // declaring a local variable


        //get all from the Car Table
        // $artists = DB::select('SELECT * FROM artists LIMIT 6');


        $artists = Artist::with('users')->orderBy('created_at', 'asc')->paginate(6);

        $recents = "";

        if (session()->has('recentSearch.artists')){
            // for ($i = count(session('recentSearch')) - 1; $i >= 0; $i--) {
                $recents = session('recentSearch.artists');
                // dd($recents->unique());
            //     $recents[] = Artist::with('users')->where('user_id', $recent)->get()->makeHidden('description');
            //     // $recents->reverse();
            //     dd($recents);
            // } 
            // dd(session('recentSearch'));

            // $recents->makeHidden('description');
        }

        // dd(session('recentSearch'));

        // dd($art  ists);

        return view($home, [
            //the data receive from Car::all will
            // be assigned to 'cars'
            'artists' => $artists,
            'recents' => $recents
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // find the id passed through and display it
        $car = Car::findOrFail($id);

        // put these findings above and show it on the page
        return view('user.cars.show', [
            'car' => $car
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
