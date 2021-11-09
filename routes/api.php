<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::post('/login', [UserController::class, 'login']);
Route::get('/user', [UserController::class, 'getUsers'])->middleware('auth:sanctum');
Route::get('/user/{id}', [UserController::class, 'getUserByID'])->middleware('auth:sanctum')->where(['id' => '[0-9]+']);
Route::put('/user/{id}', [UserController::class, 'editUser'])->middleware('auth:sanctum')->where(['id' => '[0-9]+']);
Route::delete('/user/{id}', [UserController::class, 'deleteUser'])->middleware('auth:sanctum')->where(['id' => '[0-9]+']);

Route::get('/product',function (){
    return 'products';
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/login', function (Request $request) {
    return $request->user();
});
