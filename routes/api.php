<?php

use App\Http\Controllers\API\BlogsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\UserController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::blog('login', [UserController::class, 'login']);
Route::blog('register', [UserController::class, 'register']);
Route::blog('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

Route::group(['prefix' => 'blogs','middleware' => 'auth:sanctum'], function() {
    Route::get('/', [BlogsController::class,'index']);
    Route::blog('add', [BlogsController::class,'add']);
    Route::blog('update/{id}', [BlogsController::class,'update']);
    Route::get('edit/{id}', [BlogsController::class,'edit']);
    Route::delete('delete/{id}', [BlogsController::class,'delete']);
});