<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\TrashController;

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
Route::get('/', function(){
    return view('admin.login.index');
});

Route::get('/login-admin', function(){
    return view('admin.login.index');
});

Route::post('/admin-login', [AdminController::class, 'login']);
Route::post('/admin-logout', [AdminController::class, 'logout']);

Route::group([
    'middleware' => 'adminauth',
], function($router) {
    Route::prefix('admin')->group(function () {
        Route::prefix('movie')->group(function () {
            Route::get('/', [MovieController::class, 'index'])->name('admin.movie');
            Route::get('/add', [MovieController::class, 'addMovies']);
            Route::post('/store', [MovieController::class, 'insertMovies']);
            Route::get('/edit/{id}', [MovieController::class, 'editMovies']);
            Route::post('/update/{id}', [MovieController::class, 'updateMovies']);
            Route::get('/detail/{id}', [MovieController::class, 'detailMovies']);
            Route::get('/delete/{id}', [MovieController::class, 'deleteMovies']);
        });
    
        Route::prefix('trash')->group(function () {
            Route::get('/', [TrashController::class, 'index'])->name('admin.trash');
            Route::get('/restore/{id}', [TrashController::class, 'restore']);
            Route::get('/restore-all', [TrashController::class, 'allRestore']);
            Route::get('/delete/{id}', [TrashController::class, 'delete']);
        });
    });
});
