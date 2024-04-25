<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClotheController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProviderController;


Route::get('/',[CustomerController::class,'index'])->name('index');
Route::get('/category/{category}',[CustomerController::class,'category'])->name('category.show');
Route::get('/subcategory/{subcategory}',[CustomerController::class,'subcategory'])->name('subcategory.show');



Route::middleware(['auth', 'verified','role:customer|admin|supervisor'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});


Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {

    Route::get('/admin',[AdminController::class,'index'])->name('admin');

    Route::get('/users',[UserController::class,'index']) -> name('users.index');
    Route::get('/users/edit/{user}',[UserController::class,'edit']) -> name('users.edit');
    Route::put('/users/update/{user}',[UserController::class,'update']) -> name('users.update');
    Route::delete('/user/destroy/{user}',[UserController::class,'destroy']) -> name('users.destroy');

    Route::resource('/providers', ProviderController::class);

    Route::resource('/clothes', ClotheController::class);

    Route::resource('/categories',CategoryController::class);

});


require __DIR__.'/auth.php';
