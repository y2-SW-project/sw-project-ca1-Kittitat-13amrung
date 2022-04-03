<?php

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Routes;
use App\User;
// importing controllers to be used in routing pages
use App\Http\Controllers\User\CarController as UserCarController;
use App\Http\Controllers\Admin\CarController as AdminCarController;
use App\Http\Controllers\ChatsController as ChatsController;
use App\Http\Controllers\arts as Arts;
use App\Http\Controllers\User\UserSettingController as UserSetting;
use App\Http\Controllers\Admin\UserSettingController as AdminSetting;
use App\Http\Controllers\User\ArtController as UserArtController;
use App\Http\Controllers\Admin\ArtController as AdminArtController;

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

Route::get('/chat' ,function() {
    return view('counter');
});

// Authentication to check for roles
Auth::routes();

// Route to home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// For Ordinary User auth, go to these routes
Route::get('/user/home', [Arts::class, 'index'])->name('user.home');

// settings information
Route::get('/user/profile', [AdminSetting::class, 'index'])->name('user.profile');
Route::get('/artist/profile', [AdminSetting::class, 'artist'])->name('user.profile.artist');
Route::post('/user/profile', [AdminSetting::class, 'profileUpdate'])->name('user.profile.update');
Route::post('/user/profile/update', [AdminSetting::class, 'uploadProfile'])->name('user.image.update');
Route::post('/artist/profile/update', [AdminSetting::class, 'artistUpdate'])->name('artist.profile.update');

Route::get('/admin/profile', [AdminSetting::class, 'index'])->name('admin.profile');
Route::post('/admin/profile', [AdminSetting::class, 'profileUpdate'])->name('admin.profile.update');

Route::get('artist', [UserArtController::class, 'artist'])->name('artist.show');
Route::get('/view/artist/{name}', [UserArtController::class, 'artistView'])->name('artist.view');
Route::post('/profile-upload', [UserArtController::class, 'uploadProfile'])->name('artist.upload.profile');
Route::post('/file-upload', [UserArtController::class, 'uploadFile'])->name('artist.upload.file');

// art requests
Route::get('art/requests', [UserArtController::class, 'index'])->name('arts.requests');
Route::get('user/art/requests', [UserArtController::class, 'index'])->name('user.arts.requests');
Route::get('admin/art/requests', [AdminArtController::class, 'index'])->name('admin.arts.requests');
Route::get('art/requests/{id}', [UserArtController::class, 'show'])->name('arts.requests.view');
Route::get('art/request/create', [AdminArtController::class, 'create'])->name('arts.requests.create');
// allow admin to post these new car data on the database
Route::post('arts/requests/store', [AdminArtController::class, 'store'])->name('arts.requests.store');
Route::get('art/requests/?id={id}', [UserArtController::class, 'show'])->name('arts.requests.show');

// For Admin auth, go to these routes
Route::get('/admin/home', [Arts::class, 'index'])->name('admin.home');
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


// Route::get('/', [ChatsController::class , 'index']);
// Route::get('messages', [ChatsController::class , 'fetchMessages']);
// Route::post('messages', [ChatsController::class , 'sendMessage']);

Route::get('/', [Arts::class, 'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/home', [App\Http\Controllers\HomeController::class, 'upload']);