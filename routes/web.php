<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClotheController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderClothesController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\SubCategoryController;

Route::get('/',[CustomerController::class,'index'])->name('index');
Route::get('/category/{category}',[CustomerController::class,'category'])->name('category.show');
Route::get('/subcategory/{subcategory}',[CustomerController::class,'subcategory'])->name('subcategory.show');
Route::get('/clothe/{clothe}',[CustomerController::class,'clothe']) -> name('clothe.show');


Route::middleware(['auth', 'verified','role:customer|admin|supervisor'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    //Cart controller
    Route::get('/cart',[CartController::class,'index']) -> name('cart.index');
    Route::get('/ordered',[CartController::class,'show']) -> name('cart.show');
    //API
    Route::post('/order',[CartController::class,'store']) -> name('order.store');
});


Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {

    Route::get('/admin',AdminController::class)->name('admin');


    Route::get('/users',[UserController::class,'index']) -> name('users.index');
    Route::get('/users/edit/{user}',[UserController::class,'edit']) -> name('users.edit');
    Route::put('/users/update/{user}',[UserController::class,'update']) -> name('users.update');
    Route::delete('/user/destroy/{user}',[UserController::class,'destroy']) -> name('users.destroy');

    Route::resource('/providers', ProviderController::class);

    Route::resource('/clothes', ClotheController::class);

    Route::resource('/categories',CategoryController::class);

    Route::get('/subcategories/create/{category}', [SubCategoryController::class, 'create'])->name('subcategories.create');
    Route::resource('/subcategories',SubCategoryController::class)->except(['create']);

    Route::get('/orders',[OrderClothesController::class,'index']) -> name('order.index');

});


require __DIR__.'/auth.php';
