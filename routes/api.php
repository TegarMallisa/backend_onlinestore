<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\authController;
use Illuminate\Http\Request;
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



// Route::get('product',[ProductController::class,'index']);
// Route::get('product/{id}',[ProductController::class,'show']);
// Route::post('product',[ProductController::class,'store']);
// Route::put('product/{id}',[ProductController::class,'update']);
// Route::delete('product/{id}',[ProductController::class,'destroy']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function(){
    return response()->json([
        'status' => false,
        'message' => 'Akses tidak diperbolehkan'
    ], 401);
})->name('login');

Route::apiResource('product', ProductController::class)->middleware('auth:sanctum');
Route::post('registerUser', [authController::class, 'registerUser']);
Route::post('loginUser', [authController::class, 'loginUser']);