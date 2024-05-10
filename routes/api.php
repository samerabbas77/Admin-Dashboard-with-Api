<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\Auth\LoginRegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'api'],function(){
    //Visitor
    Route::get('/visitor/book',[ApiController::class,'index']);
    Route::get('/visitor/category',[ApiController::class,'gategory_index']);
    Route::get('/visitor/filter/category',[ApiController::class,'book_filter']);
    Route::get('/visitor/filter/subcategory',[ApiController::class,'book_filter_sub']);
    //Member Auth
    Route::post('login',[LoginRegisterController::class,'login']);
    Route::post('register',[LoginRegisterController::class,'register']);
});





Route::group(['middleware' => 'sanctumMiddleware'],  //sanctumMiddleware auth:sanctum
 function(){
    Route::post('logout',[LoginRegisterController::class,'logout']);
    Route::get('user-profile',[LoginRegisterController::class,'userProfile']);

    Route::post('member/{book}',[ApiController::class,'store_favorite']);
    Route::put('member/{book}',[ApiController::class,'update_favorite']);

    Route::post('member/{book}/review',[apicontroller::class,'review']);
    Route::put('member/{book}/review',[apicontroller::class,'updteReview']);
    Route::delete('member/{book}/review',[apicontroller::class,'deletReview']);
 });
