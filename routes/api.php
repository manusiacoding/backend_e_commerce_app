<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;

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

Route::get('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function(){

    //user
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    //product
    Route::get('/products', [ProductController::class, 'index']); // all product
    Route::post('/products', [ProductController::class, 'store']); // create product
    Route::get('/products/{id}', [ProductController::class, 'show']); // show single product
    Route::put('/products/{id}', [ProductController::class, 'update']); // update product
    Route::delete('/products/{id}', [ProductController::class, 'destroy']); // delete product

    //comment
    Route::get('/products/{id}/comments', [CommentController::class, 'index']); // all comments of a product
    Route::post('/products/{id}/comments', [CommentController::class, 'store']); // create comment on a product
    Route::put('/comments/{id}', [CommentController::class, 'update']); // update a comment
    Route::delete('/comments/{id}', [CommentController::class, 'destroy']); // delete a comment

    //like
    Route::post('/products/{id}/likes', [LikeController::class, 'LikeOrUnlike']); // like or dislike back a product
});
