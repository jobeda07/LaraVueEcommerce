<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\FrontendController;

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });
Route::get('/',[FrontendController::class,'index'])->name('home');


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


 // Cart
 Route::prefix('cart')->name('cart.')->group(function (){
    Route::get('/index',[CartController::class,'index'])->name('index');
    Route::post('/store/{product}',[CartController::class,'store'])->name('store');
    Route::patch('/update/{id}',[CartController::class,'update'])->name('update');
    Route::delete('/delete/{id}',[CartController::class,'delete'])->name('delete');

 });
require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
