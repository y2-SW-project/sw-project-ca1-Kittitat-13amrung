<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Request as Req;
use App\Models\Artist;
use App\Models\Image as Img;
use Auth;

class ArtController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $clients = Req::with('users')->oldest('created_at')->get();

        // dd($clients);

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

    // redirect to artists page
    public function artist()
    {
        $artists = Artist::with('users')->latest('created_at')->get();

        // dd($artists);
        
        return view('user.arts.artist', [
            'artists' => $artists
        ]);
    }

    public  function uploadFile(Request $request)  
    {  
        $artist = Artist::where('user_id', $request->user()->id)->first();
        
        
        $file = $request->file('file');  
        $fileName = time().'.'.$file->extension(); 
        $file->storeAs('portfolio',$fileName,'public');
        $files[] = $fileName;

        if (isset($files[0])) {
            $artist->img1 = 'storage/portfolio/'.$files[0];
        }

        if (isset($files[1])) {
            $artist->img2 = 'storage/portfolio/'.$files[1];
        }

        if (isset($files[2])) {
            $artist->img3 = 'storage/portfolio/'.$files[2];
        }
        $artist->save();
  
    return response()->json(['success'=>$fileName]);  
  
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
            'traditional_art' =>'required|accepted',
            'pixel_art' => 'required|accepted',
            'digital_art' => 'required|accepted',
            'commercial_use' => 'required|accepted',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'start_price' => 'required',
            'end_price' => 'required'
        ]);

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
        $art->user_id = $request->user()->id;
        $art->save();
        
        // when done, re-route back to admin's index page
        return redirect()->route('arts.requests');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function requestView($id = 1)
    {
        if ($id == 1) return $request = Req::findOrFail(1);
        else return $request = Req::findOrFail($id);
        
        $client = User::where('id', $request->user_id)->name;

        $request->user_id = $client;
        dd($request->user_id);

        echo json_encode($request);
        exit;
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
