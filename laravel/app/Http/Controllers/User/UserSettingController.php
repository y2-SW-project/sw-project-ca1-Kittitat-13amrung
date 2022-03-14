<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class UserSettingController extends Controller
{
    // use auth to secure session and ensuring 
    // that users are routed to their respective role's index page 
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

        return view($role);
    }

    public function profileUpdate(Request $request){
        $user =Auth::user();
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

        if($request->filled(['oldPassword', 'newPassword'])) {
            $request->validate([
                'oldPassword' => 'required|min:6|string|max:255',
                'newPassword' => 'required|min:6|string|max:255'
            ]);
            
            $oldPassword = $request['oldPassword'];
            // dd($oldPassword);
            $hashedPassword = $user->password;
            
            if (Hash::check($oldPassword, $hashedPassword)) {
                // The passwords match...
                $user->password = Hash::make($request['newPassword']);
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
