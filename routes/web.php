<?php

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GategoryControlller;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('books', BookController::class);
    
});

Route::get('/gategoury',[GategoryControlller::class,'create_gategory'])->name('gategory.create');
Route::post('/gategory',[GategoryControlller::class,'store_gategory'])->name('gategory.store');
//Update
Route::get('gategory/{gategory}/edit',[GategoryControlller::class,'edit_gategory'])->name('gategory.edit');
Route::put('/gategory/{gategory}',[GategoryControlller::class,'update_gategory'])->name('gategory.update');

Route::delete('/gategoury/{gategory}',[GategoryControlller::class,'destroy_gategory'])->name('gategory.destroy');

//......................
Route::get('/subgategoury',[GategoryControlller::class,'create_sub_gategory'])->name('subgategory.create');
Route::post('/subgategory',[GategoryControlller::class,'store_sub_gategory'])->name('subgategory.store');
//Update
Route::get('subgategory/{subgategory}/edit',[GategoryControlller::class,'edit_subgategory'])->name('subgategory.edit');
Route::put('/subgategory/{subgategory}',[GategoryControlller::class,'update_subgategory'])->name('subgategory.update');
Route::delete('/subgategoury/{subgategory}',[GategoryControlller::class,'destroy_sub_gategory'])->name('subgategory.destroy');



