<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\api\PostController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\ActionLogController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('user/login', [AuthController::class, 'login']);
Route::post('user/register', [AuthController::class, 'register']);

//category with AuthController
Route::get('category', [AuthController::class, 'categoryList'])->middleware('auth:sanctum');

//all post list
Route::get('allPostList',[PostController::class, 'getAllPost']);
Route::post('post/details', [PostController::class, 'postDetails']);

//all category list
Route::get('allCategory',[CategoryController::class, 'getAllCategory']);

//post search
Route::post('post/search', [PostController::class, 'postSearch']);

//category search
Route::post('category/search', [CategoryController::class,'categorySearch']);

//action log
Route::post('post/actionLog', [ActionLogController::class, 'setActionLog']);
