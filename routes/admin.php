<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\Auth\AuthController;
use App\Http\Controllers\Backend\DashboardController;


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login/store', [AuthController::class, 'checkLogin'])->name('store');
    Route::middleware(['is_admin'])->group(function (){
      //  Route::get('/dashboard', [DashboardController::class])->name('dashboard');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    });
});

