<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Request as Req;
use App\Models\Artist;
use App\Models\User;
use App\Models\Image as Img;
use Auth;
use Intervention\Image\ImageManagerStatic as Image;

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
    public function index(Request $request)
    {
        // authentication
        $req = 'user.arts.request'; // declaring a local variable

        
        // $requests = Req::oldest('created_at')->get();
        $commissions = Req::with('users')->latest('created_at')->get();
        
        foreach ($commissions as $commission) {
            $commission->description = Str::limit($commission->description, 60, ' ...');
            $commission->attachExpire();
        }


        $sorted = $commissions->sortBy([
            ['end_date', 'desc']
        ]);
        

        $sorted->values()->all();

        // dd($commissions->sortBy('expired'));

        // dd($requests);  
        return view($req, [
            // 'requests' => $requests,
            'commissions' => $sorted
        ]);
    }

    public function firstReq() {
        $commission = Req::with('users')->latest()->get()->first();
        // return $client = json_encode($client);

        $client = User::where('id', $commission->user_id)->get('name')->first();

        $commission->user_id = $client->name;
        
        return $commission->makeHidden('users');
    }

    public function show() {
        $clients = Req::with('users')->oldest('created_at')->paginate(6);
        
        foreach ($clients as $client) {
            $client->description = Str::limit($client->description, 60, ' ...');
        }

        // dd($clients);

        echo($clients); 
    }

    public function ajaxFavourite(Request $request) {
        $this->authorize('favouritable');

        if ($request->ajax()) {
            $artist = Artist::findOrFail($request->id);
    
            $reply = Auth::user()->toggleFavorite($artist);

            if (Auth::user()->hasFavorited($artist)) {
                $response = $artist;
            } else {
                $response = true;
            }
            // dd($response);
            return response()->json(['favourited'=>$response]);
        }


    }

    public function ajaxLike(Request $request) {
        $this->authorize('likable');

        if ($request->ajax()) {
            $artist = Artist::findOrFail($request->id);
    
            $response = auth()->user()->toggleLike($artist);
    
            return response()->json(['liked'=>$response]);
        }


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
        // dd($this->authorize('likable'));
        $artists = Artist::with('users')->latest('created_at')->paginate(12);
        // dd(Auth::user()->hasFavorited($artist));
        // dd($artists);
        // dd(session('recentSearch')[0]->id);

        // if (Auth::user()->hasFavorited($artist)) {
        //     $response = true;
        // } else {
        //     $response = false;
        // }
        
        return view('user.arts.artist', [
            'artists' => $artists
        ]);
    }
    
    public function artistView($id) {
        $artist = Artist::where('id', $id)->with('users')->get()->first();

        $user = Auth::user();
        // $user->favorite($artist);


        // dd($user->getFavoriteItems(Artist::class));
        

        if (Auth::check()) {
            session()->push('recentSearch.artists', $id);
        }

        // session()->forget('recentSearch');

        // $artist->users->makeHidden('password');
// dd(session('recentSearch.artists'));
        return view('user.arts.view', [
            'artist' => $artist
        ]);
    }
 
    public  function uploadFile(Request $request)  
    {  
        $artist = Artist::where('user_id', $request->user()->id)->first();
        
        
        $file = $request->file('file');
        $fileCompressed = Image::make($file);
        $fileCompressed->widen(600, function ($constraint) {
            $constraint->upsize();
        });

        $fileName = time(); 
        $fileCompressed->save('storage/artists/thumbnails/'.$fileName.'.jpg', 90, 'jpg');

        $fileOriginalName = time().'.png'; 
        $file->storeAs('artists/arts/',$fileOriginalName,'public');

        // $files[] = $fileName;
        if (is_null($artist->img1)) {
            $artist->img1 = $fileName;
        } else if (is_null($artist->img2)) {
            $artist->img2 = $fileName;
        } else if (is_null($artist->img3)) {
            $artist->img3 = $fileName;
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
            'start_date' => 'required|after:yesterday',
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
        if ($id == 1) { $request = Req::findOrFail(1);}
        else { $request = Req::findOrFail($id);}
        
        $client = User::where('id', $request->user_id)->get('name')->first();

        $request->user_id = $client->name;

        return $request;
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
        $art = Req::findOrFail($id);
        // data validation
        $request->validate([
            'title' => 'required|min:3',
            'traditional_art' =>'required_without_all:pixel_art,digital_art',
            'pixel_art' => 'required_without_all:digital_art,traditional_art',
            'digital_art' => 'required_without_all:pixel_art,traditional_art',
            'commercial_use' => 'required',
            'start_date' => 'required|date',
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
        $art->title = $request->title;
        $art->commercial_use = $request->commercial_use;
        $art->start_date = $request->start_date;
        $art->end_date = $request->end_date;
        $art->start_price = $request->start_price;
        $art->end_price = $request->end_price;
        $art->digital_art = $request->digital_art;
        $art->traditional_art = $request->traditional_art;
        $art->pixel_art = $request->pixel_art;
        $art->description = $request->request1;
        $art->user_id = $request->user()->id;
        $art->save();
        
        // when done, re-route back to admin's index page
        return redirect()->route('arts.requests');
    }
    
    protected function deleteOldImage()
    {
      if (auth()->user()->image !== 'user.png'){
        Storage::delete('/public/profile/'.auth()->user()->image);
      }
     }

     public  function uploadProfile(Request $request)  
     {  
        //  dd($request);
        $user = Auth::user();
 
        $this->deleteOldImage(); 
        $file = $request->file('file');  
        $fileName = time().'.'.$file->extension(); 
        $file->storeAs('profile',$fileName,'public');  
        $user->update(['image'=> $fileName]);
   
        return response()->json(['success'=>$fileName]);  
   
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
