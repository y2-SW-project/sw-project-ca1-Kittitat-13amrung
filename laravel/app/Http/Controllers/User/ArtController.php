<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Request as Req;
use Auth;

class ArtController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware('auth');
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
        $req = 'home'; // declaring a local variable

        // check if user is an admin
        if($user->hasRole('admin')) {
            $req = 'admin.arts.request'; //if so route to admin page
        }

        // if user is an ordinary user
        else if ($user->hasRole('user')) {
            $req = 'user.arts.request'; //route to user page
        }
        
        $requests = Req::oldest('created_at')->get();
        $clients = Req::with('users')->get();

        // dd($users);

        // dd($requests);  
        return view($req, [
            'requests' => $requests,
            'clients' => $clients
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.arts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // when user clicks submit on the create view above
        // the car will be stored in the database

        // data validation
        $request->validate([
            'title' => 'required|min:3',
            'traditional_art' =>'',
            'pixel_art' => '',
            'digital_art' => '',
            'commercial_use' => '',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'start_price' => 'required',
            'end_price' => 'required'
        ]);

        if ($request->pixel_art == "on") {
            $request->pixel_art = 1;
        }

        if ($request->traditional_art == "on") {
            $request->traditional_art = 1;
        }

        if ($request->digital_art == "on") {
            $request->digital_art = 1;
        }

        if ($request->pixel_art !== "on") {
            $request->pixel_art = 0;
        }

        if ($request->traditional_art !== "on") {
            $request->traditional_art = 0;
        }

        if ($request->digital_art !== "on") {
            $request->digital_art = 0;
        }

        if ($request->commercial_use == "true") {
            $request->commercial_use = 1;
        } else {
            $request->commercial_use = 0;
        }
            // // store file to the location specified
            // $request->file->store('image', 'public');
            
            // // create a local variable to assign new image to it
            // $image = $request->file('file')->hashName();

        // if validation passes create the new car
        $art = new Req();
        $art->title = $request->title;
        $art->commercial_use = $request->commercial_use;
        $art->start_date = $request->start_date;
        $art->end_date = $request->end_date;
        $art->start_price = $request->start_price;
        $art->end_price = $request->end_price;
        $art->digital_art = $request->digital_art;
        $art->traditional_art = $request->traditional_art;
        $art->pixel_art = $request->pixel_art;
        $art->save();
        
        $user = new reqUser();
        $user->user_id = $request->user()->id;
        $user->request_id = $art->id;
        $user->save();
        // when done, re-route back to admin's index page
        return redirect()->route('arts.requests');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Req $id)
    {
        return view('arts.show', ['request', $id]);
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
