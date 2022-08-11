<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\ProductController;
use App\Http\Controllers\Products as ProductsController;
use App\Http\Resources\Products as ProductsResource;
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

Route::resource('products' , ProductsController::class);
Route::resource('type' , ProductsController::class);

// Route::prefix('products',function(){
//     Route::get('/create' , [ProductController::class , 'create']);
//     Route::get('/update/{id}' , [ProductController::class , 'update']);

// });
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
