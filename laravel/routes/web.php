<?php

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Routes;
use App\User;
// importing controllers to be used in routing pages
use App\Http\Controllers\User\HomeController as UserController;
use App\Http\Controllers\Admin\HomeController as AdminController;
use App\Http\Controllers\ChatsController as ChatsController;
use App\Http\Controllers\Auth\LoginController as LoginController;
use App\Http\Controllers\arts as Arts;
use App\Http\Controllers\User\UserSettingController as UserSetting;
use App\Http\Controllers\Admin\UserSettingController as AdminSetting;
use App\Http\Controllers\User\ArtController as UserArtController;
use App\Http\Controllers\Admin\ArtController as AdminArtController;
use Intervention\Image\ImageManagerStatic as Image;
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
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::delete('/user/delete/{id}', [AdminController::class, 'deleteUser'])->name('users.delete');
    Route::delete('/artists/delete/{id}', [AdminController::class, 'deleteArtist'])->name('artist.delete');
    Route::get('/artists', [AdminController::class, 'artists'])->name('artists');
    Route::get('/requests', [AdminController::class, 'requests'])->name('requests');
    Route::get('profile', [AdminSetting::class, 'index'])->name('profile');
    Route::post('profile', [AdminSetting::class, 'profileUpdate'])->name('profile.update');
});

Route::get('/', [Arts::class, 'index'])->name('user.index');

Route::group([
    'prefix' => 'user',
    'as' => 'user.',
], function() {
    // User info settings
    Route::get('profile', [AdminSetting::class, 'index'])->name('profile');
    Route::get('favourites', [AdminSetting::class, 'favourites'])->name('favourites');
    Route::get('requests', [AdminSetting::class, 'requests'])->name('requests.list');

    // Artist info settings
    Route::get('artist/profile', [AdminSetting::class, 'artist'])->name('profile.artist');


    // Post and Update User Info 
    Route::post('profile/update', [AdminSetting::class, 'profileUpdate'])->name('profile.update');
    Route::post('profile/upload', [AdminSetting::class, 'uploadProfile']);
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
    Route::post('/file/upload', [UserArtController::class, 'uploadFile'])->name('upload.file');
});

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
    // allow admin to post these new request data on the database
    Route::post('requests/store', [AdminArtController::class, 'store'])->name('.store');
    Route::get('requests/?id={id}', [UserArtController::class, 'show'])->name('.show');
});
Route::get('user/art/requests', [UserArtController::class, 'index'])->name('user.arts.requests');
Route::get('admin/art/requests', [AdminArtController::class, 'index'])->name('admin.arts.requests');

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
