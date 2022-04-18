<?php

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Routes;
use App\User;
// importing controllers to be used in routing pages
use App\Http\Controllers\User\CarController as UserCarController;
use App\Http\Controllers\Admin\CarController as AdminCarController;
use App\Http\Controllers\ChatsController as ChatsController;
use App\Http\Controllers\Auth\LoginController as LoginController;
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
Route::post('/login/authenticate', [LoginController::class, 'authenticate'])->name('login.authenticate');

// Route to home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// For Ordinary User auth, go to these routes
Route::get('/user/home', [Arts::class, 'index'])->name('user.home');

Route::group([
    'prefix' => 'admin',
    'middleware' => 'is_admin',
    'as' => 'admin.',
], function() {
    
});

Route::group([
    'prefix' => 'user',
    'as' => 'user.',
], function() {
    // User info settings
    Route::get('profile', [AdminSetting::class, 'index'])->name('profile');
    Route::get('favourites', [AdminSetting::class, 'favourites'])->name('favourites');

    // Artist info settings
    Route::get('artist/profile', [AdminSetting::class, 'artist'])->name('profile.artist');


    // Post and Update User Info 
    Route::post('profile', [AdminSetting::class, 'profileUpdate'])->name('profile.update');
    Route::post('profile/update', [AdminSetting::class, 'uploadProfile'])->name('image.update');
});

Route::group([
    'prefix' => 'artist',
    'as' => 'artist.',
], function() {
    Route::get('/', [UserArtController::class, 'artist'])->name('show');
    Route::get('/view/{name}', [UserArtController::class, 'artistView'])->name('view');
    Route::post('/fetch/like', [UserArtController::class, 'ajaxLike'])->name('like');
    Route::post('/fetch/favourite', [UserArtController::class, 'ajaxFavourite'])->name('favourite');
    Route::post('/profile/update', [AdminSetting::class, 'artistUpdate'])->name('profile.update');
    Route::post('/profile-upload', [UserArtController::class, 'uploadProfile'])->name('upload.profile');
    Route::post('/file-upload', [UserArtController::class, 'uploadFile'])->name('upload.file');
});

Route::get('/admin/profile', [AdminSetting::class, 'index'])->name('admin.profile');
Route::post('/admin/profile', [AdminSetting::class, 'profileUpdate'])->name('admin.profile.update');

Route::group([
    'prefix' => 'art',
    'as' => 'arts.requests',
], function() {
    // art requests
    Route::get('requests', [UserArtController::class, 'index']);
    Route::get('requests/first', [UserArtController::class, 'firstReq'])->name('.first');
    Route::get('requests/show', [UserArtController::class, 'show'])->name('.show');
    Route::get('requests/{id}', [UserArtController::class, 'requestView'])->name('.view');
    Route::get('request/create', [AdminArtController::class, 'create'])->name('.create');
    Route::get('request/edit/{id}', [AdminArtController::class, 'edit'])->name('.edit');
    Route::post('delete/{id}', [AdminArtController::class, 'destroy'])->name('.delete');
    Route::post('store/{id}', [AdminArtController::class, 'update'])->name('.update');
    // allow admin to post these new car data on the database
    Route::post('requests/store', [AdminArtController::class, 'store'])->name('.store');
    Route::get('requests/?id={id}', [UserArtController::class, 'show'])->name('.show');
});
Route::get('user/art/requests', [UserArtController::class, 'index'])->name('user.arts.requests');
Route::get('admin/art/requests', [AdminArtController::class, 'index'])->name('admin.arts.requests');

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