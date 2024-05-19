<?php

use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\api\CommentController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);    
});

Route::middleware(['jwt.verify'])->group(function () {
    // for categories
    Route::get('/categories',[CategoryController::class,'index']);
    Route::get('/category/{id}',[CategoryController::class,'show']);
    Route::post('/categories',[CategoryController::class,'store']);
    Route::put('/category/{id}',[CategoryController::class,'update']);
    Route::delete('/category/{id}',[CategoryController::class,'destroy']);
    // for posts
    Route::get('/posts',[PostController::class,'index']);
    Route::get('/post/{id}',[PostController::class,'show']);
    Route::post('/posts',[PostController::class,'store']);
    Route::put('/post/{id}',[PostController::class,'update']);
    Route::delete('/post/{id}',[PostController::class,'destroy']);
    // for comments
    Route::get('/comments',[CommentController::class,'index']);
    Route::post('/comments',[CommentController::class,'store']);
    Route::put('/comment/{id}',[CommentController::class,'update']);
    Route::delete('/comment/{id}',[CommentController::class,'destroy']);
});