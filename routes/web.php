<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrendPostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    //admin home page route
    Route::get('dashboard', [ProfileController::class, 'index'])->name('dashboard');
    Route::post('admin/update', [ProfileController::class, 'updateAdminAcount'])->name('admin.update');
    Route::get('admin/changePassword', [ProfileController::class, 'changingPassword'])->name('admin.changepassword');
    Route::post('admin/changePassword', [ProfileController::class, 'changePassword'])->name('admin.passwordchange');

    //admin list route
    Route::get('admin/list', [ListController::class, 'index'])->name('admin.list');
    Route::get('admin/delete/{id}', [ListController::class, 'adminAccountDelete'])->name('admin.accountDelete');
    Route::post('admin/list', [ListController::class, 'adminListSearch'])->name('admin.listSearch');

    //post list
    Route::get('post', [PostController::class, 'index'])->name('admin.post');

    //category list
    Route::get('category', [CategoryController::class, 'index'])->name('admin.category');
    Route::post('category', [CategoryController::class, 'createCategory'])->name('admin.createCategory');
    Route::get('category/delete/{id}', [CategoryController::class, 'deleteCategory'])->name('admin.deleteCategory');
    Route::post('category/search', [CategoryController::class, 'categorySearch'])->name('admin.categorySearch');
    Route::get('category/editPage/{id}', [CategoryController::class, 'categoryEditPage'])->name('admin.categoryEditPage');
    Route::post('category/update/{id}', [CategoryController::class, 'updateCategory'])->name('admin.categoryUpdate');

    //trend post
    Route::get('trendpost', [TrendPostController::class, 'index'])->name('admin.trendpost');
});
