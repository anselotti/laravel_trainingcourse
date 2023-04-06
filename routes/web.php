<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\ListingLogoController;
use App\Http\Controllers\UserController;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

////////////////////////////
///// LISTING ROUTES ///////
////////////////////////////

// All listings
Route::get('/', [ListingController::class, 'index']);

//show create-form
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

// store Listing data
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');

// show edit form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

// Update listing
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

// Delete listing
Route::delete('/listings/{listing}', [ListingController::class, 'delete'])->middleware('auth');

// Manage listings
Route::get('/listings/manage',[ListingController::class, 'manage'])->middleware('auth');

//Delete logo
Route::delete('/listings/{id}/logo', [ListingLogoController::class, 'deleteLogo'])->name('listings.logo.destroy')->middleware('auth');

////////////////////////////
/////// USER ROUTES ////////
////////////////////////////

// Show register/create-form 
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

// create new user
Route::post('/users', [UserController::class, 'store']);

// logout
Route::post('/logout',[UserController::class, 'logout'])->middleware('auth');

// login
Route::get('/login',[UserController::class, 'login'])->name('login')->middleware('guest');

// authentication
Route::post('/users/authenticate',[UserController::class, 'authenticate']);





// Single Listing
Route::get('/listings/{listing}', [ListingController::class, 'show']);





// Route::get('/hello', function() {
//     return response('<h1>Hello World!</h1>', 200)
//     ->header('Content-Type', 'text/plain')
//     ->header('foo', 'bar');
// });

// Route::get('/posts/{id}', function($id) {
//     return response(('Post ' . $id));
// })->where('id', '[0-9]+');

// Route::get('/search', function(Request $request){
//     $request->name . ' ' . $request->city;
// });