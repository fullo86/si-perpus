<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('not_login')->group(function() {
    Route::get('/register', [AuthController::class, 'register']);
    Route::post('/register', [AuthController::class, 'registUser']);
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
});

Route::middleware('auth')->group(function() {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/edit/member/{slug}', [MemberController::class, 'edit']);
    Route::put('/edit-member/update/{slug}', [MemberController::class, 'update']);


    Route::middleware('auth-member')->group(function() {
        //Route Dashboard
        Route::get('/dashboards', [MemberController::class, 'profile'])->middleware('auth-member');

        //Route Books List
        Route::get('/books/list', [BookController::class, 'listBook']);

        //Routes Activity Transaction
        Route::get('/activity', [ActivityController::class, 'index']);
        Route::post('/activity/save', [ActivityController::class, 'store']);
        Route::get('/return', [ActivityController::class, 'return']);
        Route::post('/return', [ActivityController::class, 'returnProses']);
    });

    Route::middleware('auth-admin')->group(function() {
        Route::get('/dashboard', [AdminController::class, 'index']);

        //Routes Member
        Route::get('/members', [MemberController::class, 'index']);
        Route::get('/show/member/{slug}', [MemberController::class, 'show']);
        Route::patch('/active/member/{slug}', [MemberController::class, 'approve']);
        Route::delete('/delete-member/{slug}', [MemberController::class, 'destroy']);

        //Routes Books
        Route::get('/books', [BookController::class, 'index']);
        Route::get('/show/book/{slug}', [BookController::class, 'show']);
        Route::get('/create/book', [BookController::class, 'create']);
        Route::post('/create-book/save', [BookController::class, 'store']);
        Route::get('/edit/book/{slug}', [BookController::class, 'edit']);
        Route::put('/edit-book/update/{slug}', [BookController::class, 'update']);
        Route::patch('/status/book/{slug}', [BookController::class, 'status']);
        Route::delete('/delete-book/{slug}', [BookController::class, 'destroy']);
    
        //Routes Categories
        Route::get('/category', [CategoryController::class, 'index']);
        Route::get('/create/category', [CategoryController::class, 'create']);
        Route::post('/create-category/save', [CategoryController::class, 'store']);
        Route::get('/edit/category/{slug}', [CategoryController::class, 'edit']);
        Route::put('/edit-category/update/{slug}', [CategoryController::class, 'update']);
        Route::delete('/delete-category/{slug}', [CategoryController::class, 'destroy']);

        //Routes Logs 
        Route::get('/logs', [LogsController::class, 'index']);
    });
});
