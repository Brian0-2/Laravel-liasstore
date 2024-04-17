<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClotheController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProviderController;

Route::get('/',[CustomerController::class,'index'])->name('index');
Route::get('/category/{category}',[CustomerController::class,'category'])->name('category.show');


Route::middleware('auth','verified')->group(function () {

    Route::get('/admin',[AdminController::class,'index'])->name('admin');

    Route::get('/users',[UserController::class,'index']) -> name('users.index');
    Route::get('/users/edit/{user}',[UserController::class,'edit']) -> name('users.edit');
    Route::put('/users/update/{user}',[UserController::class,'update']) -> name('users.update');
    Route::delete('/user/destroy/{user}',[UserController::class,'destroy']) -> name('users.destroy');

    Route::resource('/providers', ProviderController::class);

    Route::resource('/clothes', ClotheController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
