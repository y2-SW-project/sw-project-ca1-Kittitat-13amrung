<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Artist;
use App\Models\User;
use App\Models\User_Role as Role;
use Auth;

class UserSettingController extends Controller
{

    public function __construct()
    {
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
        $role = 'home'; // declaring a local variable

        // check if user is an admin
        if($user->hasRole('admin')) {
            $role = 'admin.settings.profile'; //if so route to admin page
        }

        // if user is an ordinary user
        else if ($user->hasRole('user')) {
            $role = 'user.settings.profile'; //route to user page
        }

        $tags = User::with('roles')
        ->where('id', $user->id)->get();
        return view($role, [
            'tags' => $tags
        ]);
    }

    public function profileUpdate(Request $request){
        $user = Auth::user();
        //validation rules
        
        $request->validate([
            'name' =>'required|min:4|string|max:255',
            'email'=>'required|email|string|max:255',
        ]);
        
        if($request->hasFile('image')){
            $request->validate([
                'image' => 'required|mimes:jpg,png'
            ]);
            $this->deleteOldImage(); 
            $filename = $request['image']->getClientOriginalName();
            $request['image']->storeAs('profile',$filename,'public');
            $user->update(['image'=>$filename]);
        }

        if($request->filled(['oldPassword', 'password'])) {
            $request->validate([
                'oldPassword' => 'required|min:6|string|max:255',
                'password' => 'required|confirmed|min:6|string|max:255'
            ]);
            
            $oldPassword = $request['oldPassword'];
            // dd($oldPassword);
            $hashedPassword = $user->password;
            
            if (Hash::check($oldPassword, $hashedPassword)) {
                // The passwords match...
                $user->password = Hash::make($request['password']);
            } else {
                return back()->withError("Password do not matched");
            }
        }
        
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->save();
        return back()->with('message','Profile Updated');
    }

    protected function deleteOldImage()
    {
      if (auth()->user()->image !== 'user.png'){
        Storage::delete('/public/profile/'.auth()->user()->image);
      }
     }

     public  function uploadProfile(Request $request)  
     {  
        $user = Auth::user();
 
        $this->deleteOldImage(); 
        $file = $request->file('file');  
        $fileName = time().'.'.$file->extension(); 
        $file->storeAs('profile',$fileName,'public');  
        $user->update(['image'=> $fileName]);
   
        return response()->json(['success'=>$fileName]);  
   
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function artist()
    {
        $artist = Artist::firstOrCreate(
            ['user_id' =>  Auth::user()->id],
            ['user_id' => Auth::user()->id]
        );
        
        return view('user.settings.artist', [
            'artist' => $artist
        ]);
    }

        // updating artist profile
    public function artistUpdate(Request $request) {
        $artist = Artist::firstOrCreate(
            ['user_id' =>  $request->user()->id],
            ['user_id' => $request->user()->id]
        );

        
        $request->validate([
            'duration' => 'min:1|max:60',
            'start_price' => 'integer|lt:end_price|min:5',
            'end_price' => 'integer|gt:start_price',
            'status' => 'boolean',
            'editor1' => 'nullable'
        ]);
        $artist->description = $request['editor1'];
        $artist->duration = $request['duration'];
        $artist->start_price = $request['start_price'];
        $artist->end_price = $request['end_price'];
        $artist->status = $request['status'];
        $artist->save();

        return redirect()->route('user.profile.artist');

        // $content = $request['editor1'];
        // $artist->descriptions = $content;
        // $artist->duration = $request['duration'];
        // $artist->start_price = $request['start_price'];
        // $artist->end_price = $request['end_price'];
        // $artist->status = $request['status'];
        // $artist->save();
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
    public function Artistshow($id)
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
