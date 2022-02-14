<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use Auth;

class CarController extends Controller
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

        $storagePath = storage_path('image/');
        // authentication
        $user = Auth::user();
        $car = 'home'; // declaring a local variable

        // check if user is an admin
        if($user->hasRole('admin')) {
            $car = 'admin.cars.index'; //if so route to admin page
        }

        // if user is an ordinary user
        else if ($user->hasRole('user')) {
            $car = 'user.cars.index'; //route to user page
        }

        //get all from the Car Table
        $cars = Car::all();
        return view($car, [
            //the data receive from Car::all will
            // be assigned to 'cars'
            'cars' => $cars,
            'storagePaths' => $storagePaths
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // re-route admin to the create page
        return view('admin.cars.create');
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
            'make' => 'required|min:3',
            'model' =>'required|min:3',
            'price' => 'required',
            'engine_size' => 'required',
            'file' => 'required|mimes:jpeg,jpg,bmp,png'
        ]);

            // store file to the location specified
            $request->file->store('image', 'public');
            
            // create a local variable to assign new image to it
            $image = $request->file('file')->hashName();

        // if validation passes create the new car
        $car = new Car();
        $car->make = $request->input('make');
        $car->model = $request->input('model');
        $car->price = $request->input('price');
        $car->engine_size = $request->input('engine_size');
        $car->image_location = $image;
        $car->save();

        // when done, re-route back to admin's index page
        return redirect()->route('admin.cars.index');
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
        return view('admin.cars.show', [
            'car' => $car,
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
        // get the car by ID from the Database
        $car = Car::findOrFail($id);

        // Load the edit view and pass the car to
        // that view
        return view('admin.cars.edit', [
            'car' => $car
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
        // first get the existing car that the user is update
        $car = Car::findOrFail($id);

        // validate those data
        $request->validate([
            'make' => 'required|min:3',
            'model' =>'required|min:3',
            'price' => 'required',
            'engine_size' => 'required'
        ]);

        // for any images validate it
        // store in a location
        if ($request->hasFile('file')) {
            $request->validate([
                'file' => 'mimes:jpeg,jpg,bmp,png'
            ]);

            // store the image in the destination folder
            $request->file->store('image', 'public');

            // update the data of the file name
            $image = $request->file->hashName();

        }

        // if validation passes then update existing car
        $car->make = $request->input('make');
        $car->model = $request->input('model');
        $car->price = $request->input('price');
        $car->engine_size = $request->input('engine_size');
        $car->image_location = $image;
        $car->save();

        return redirect()->route('admin.cars.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // find the car id
        $car = Car::findOrFail($id);
        $car->delete(); //and delete it

        // go back to the index page
        return redirect()->route('admin.cars.index');
    }
}
