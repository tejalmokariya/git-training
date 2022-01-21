<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RatingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::match(["GET", "POST"], '/login', [UserController::class, "login"])->name('login');
Route::post('/logout', 'UserController@logout');


Route::group(['middleware'=>['auth:api']],function () {


    Route::post('/addrating', [RatingController::class, "store"]);
    Route::post('/addproduct', [ProductController::class, "addProduct"]);
    Route::post('/updateproduct', [ProductController::class, "updateProduct"]); 
    Route::post('/deleteproduct', [ProductController::class, "destroy"]);
    Route::post('/detailsproduct', [ProductController::class, "getProduct"]);
 

   
   
});