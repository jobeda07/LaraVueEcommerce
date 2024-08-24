<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\Auth\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login/store', [AuthController::class, 'checkLogin'])->name('store');
    Route::middleware(['is_admin'])->group(function (){
      //  Route::get('/dashboard', [DashboardController::class])->name('dashboard');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');

        // product
        Route::prefix('product')->name('product.')->group(function (){
           Route::get('/', [ProductController::class, 'index'])->name('index');
           Route::get('/create', [ProductController::class, 'create'])->name('create');
           Route::post('/store', [ProductController::class, 'store'])->name('store');
           Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');
           Route::put('/update/{id}', [ProductController::class, 'update'])->name('update');
           Route::delete('/delete/{id}', [ProductController::class, 'delete'])->name('delete');
           Route::delete('/deleteImage/{id}', [ProductController::class, 'deleteImage'])->name('deleteImage');
           Route::get('/changePublish/{id}', [ProductController::class, 'changePublish'])->name('changePublish');

        });


    });
});

