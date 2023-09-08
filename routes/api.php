<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\FavoriteProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductsByCategoryController;
use App\Models\FavoriteProducts;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;

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



Route::middleware('auth:sanctum')->group(function(){
    
    Route::post('/logout',[AuthController::class,'logout']);

    Route::post('/user', function (Request $request) {
        $request->cookie();
        return $request->user();
        // return Cookie::forget('laravel_session');
    });
    Route::post('/addproduct',[ProductController::class,'store']);

    Route::post('/addfavorite',[FavoriteProductController::class,'store']);
    
    Route::get('/getfavorite',[FavoriteProductController::class,'index']);
    
    Route::post('/deletefavorite',[FavoriteProductController::class,'destroy']);

});
Route::get('/products/{productId}',[ProductController::class,'show']);

Route::get('/testapi', function(){
    return response()->json("Its Working!");
});

Route::get('/products/category/{categoryId}',[ProductController::class,'productByCategory']);

Route::get('/products',[ProductController::class,'index']);

Route::post('/login',[AuthController::class,'login']);
Route::post('/register',[AuthController::class,'register']);







