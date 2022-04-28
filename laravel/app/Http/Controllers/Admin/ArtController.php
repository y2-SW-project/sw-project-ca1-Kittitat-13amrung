<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Request as Req;
use App\Models\User_Requests as reqUser;
use App\Models\User;
use Auth;

class ArtController extends Controller
{

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
        $req = 'user.arts.request'; // declaring a local variable

        
        // $requests = Req::oldest('created_at')->get();
        $clients = Req::with('users')->latest('created_at')->get();

        // dd($users);

        // dd($requests);  
        return view($req, [
            // 'requests' => $requests,
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
            'traditional_art' =>'required_without_all:pixel_art,digital_art',
            'pixel_art' => 'required_without_all:digital_art,traditional_art',
            'digital_art' => 'required_without_all:pixel_art,traditional_art',
            'commercial_use' => 'required',
            'start_date' => 'required|date|after:yesterday',
            'end_date' => 'required|date|after_or_equal:start_date',
            'start_price' => 'required|lt:end_price',
            'end_price' => 'required|gt:start_price',
            'request1' => 'nullable'
        ]);

        
        if ($request->pixel_art == "on") {
            $request->pixel_art = 1;
        } else {
            $request->pixel_art = 0;
        }
        
        if ($request->traditional_art == "on") {
            $request->traditional_art = 1;
        } else {
            $request->traditional_art = 0;
        }
        
        if ($request->digital_art == "on") {
            $request->digital_art = 1;
        } else {
            $request->digital_art = 0;
        }

        
        if ($request->commercial_use == "true") {
            $request->commercial_use = 1;
        } else {
            $request->commercial_use = 0;
        }
        // dd($request->pixel_art);
            // // store file to the location specified
            // $request->file->store('image', 'public');
            
            // // create a local variable to assign new image to it
            // $image = $request->file('file')->hashName();

            // dd($request);
        // if validation passes create the new car
        $commission = new Req();
        $commission->title = $request->title;
        $commission->commercial_use = $request->commercial_use;
        $commission->start_date = $request->start_date;
        $commission->end_date = $request->end_date;
        $commission->start_price = $request->start_price;
        $commission->end_price = $request->end_price;
        $commission->digital_art = $request->digital_art;
        $commission->traditional_art = $request->traditional_art;
        $commission->pixel_art = $request->pixel_art;
        $commission->description = $request->request1;
        $commission->user_id = $request->user()->id;
        $commission->save();
        
        // when done, re-route back to admin's index page
        return redirect()->route('arts.requests');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $req = Req::findOrFail($id);

        $this->authorize('isClient', $req);

        return view('user.arts.edit', [
            'req' => $req
        ]);
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

        // when user clicks submit on the create view above
        // the car will be stored in the database
        $commission = Req::findOrFail($id);

        $this->authorize('isClient', $commission);

        // data validation
        $request->validate([
            'title' => 'required|min:3',
            'traditional_art' =>'required_without_all:pixel_art,digital_art',
            'pixel_art' => 'required_without_all:digital_art,traditional_art',
            'digital_art' => 'required_without_all:pixel_art,traditional_art',
            'commercial_use' => 'required',
            'end_date' => 'required|date|after_or_equal:start_date',
            'start_price' => 'required|lt:end_price',
            'end_price' => 'required|gt:start_price',
            'request1' => 'nullable'
        ]);

        
        if ($request->pixel_art == "on") {
            $request->pixel_art = 1;
        } else {
            $request->pixel_art = 0;
        }
        
        if ($request->traditional_art == "on") {
            $request->traditional_art = 1;
        } else {
            $request->traditional_art = 0;
        }
        
        if ($request->digital_art == "on") {
            $request->digital_art = 1;
        } else {
            $request->digital_art = 0;
        }

        
        if ($request->commercial_use == "true") {
            $request->commercial_use = 1;
        } else {
            $request->commercial_use = 0;
        }
        // dd($request->pixel_art);
            // // store file to the location specified
            // $request->file->store('image', 'public');
            
            // // create a local variable to assign new image to it
            // $image = $request->file('file')->hashName();

            // dd($request);
        // if validation passes create the new car
        $commission->title = $request->title;
        $commission->commercial_use = $request->commercial_use;
        $commission->end_date = $request->end_date;
        $commission->start_price = $request->start_price;
        $commission->end_price = $request->end_price;
        $commission->digital_art = $request->digital_art;
        $commission->traditional_art = $request->traditional_art;
        $commission->pixel_art = $request->pixel_art;
        $commission->description = $request->request1;
        $commission->user_id = $request->user()->id;
        $commission->save();
        
        // when done, re-route back to admin's index page
        return redirect()->route('arts.requests');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $commission = Req::findOrFail($id);

        $this->authorize('isClient', $commission);

        $commission->delete();

        return redirect()->route('arts.requests');
    }

    public function deleteUser($id)
    {
        $this->authorize('admin');

        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('admin.index');
    }
}
