<?php

use Illuminate\Support\Facades\Route;
// importing controllers to be used in routing pages
use App\Http\Controllers\User\CarController as UserCarController;
use App\Http\Controllers\Admin\CarController as AdminCarController;
use App\Http\Controllers\ChatsController as ChatsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Authentication to check for roles
Auth::routes();

// Route to home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// For Ordinary User auth, go to these routes
Route::get('/user/home', [App\Http\Controllers\User\HomeController::class, 'index'])->name('user.home');
// display car information
Route::get('/user/cars/', [UserCarController::class, 'index'])->name('user.cars.index');
// view car details
Route::get('/user/cars/{id}', [UserCarController::class, 'show'])->name('user.cars.show');

// For Admin auth, go to these routes
Route::get('/admin/home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.home');
// display car info with editing power
Route::get('/admin/cars/', [AdminCarController::class, 'index'])->name('admin.cars.index');
// allow admin to create a new data of car
Route::get('/admin/cars/create', [AdminCarController::class, 'create'])->name('admin.cars.create');
// view car details
Route::get('/admin/cars/{id}', [AdminCarController::class, 'show'])->name('admin.cars.show');
// allow admin to post these new car data on the database
Route::post('/admin/cars/store', [AdminCarController::class, 'store'])->name('admin.cars.store');
// allow admin to edit these car data
Route::get('/admin/cars/{id}/edit', [AdminCarController::class, 'edit'])->name('admin.cars.edit');
// allow admin to post these new edited data to the database 
Route::put('/admin/cars/{id}', [AdminCarController::class, 'update'])->name('admin.cars.update');
// 
Route::delete('/admin/cars/{id}', [AdminCarController::class, 'destroy'])->name('admin.cars.destroy');
Auth::routes();


Route::get('/', [ChatsController::class , 'index']);
Route::get('messages', [ChatsController::class , 'fetchMessages']);
Route::post('messages', [ChatsController::class , 'sendMessage']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
