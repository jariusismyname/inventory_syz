<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

Route::post('/checkout', [AdminController::class, 'checkout'])
    ->name('checkout');
Route::delete('/inventory/{id}', [AdminController::class, 'destroy'])
    ->name('inventory.destroy');
Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');

Route::get('/', function () {
    return view('welcome');
});

 

Route::get('/redirects', [HomeController::class, 'index']);
 
Route::get('/dashboard',[UserController::class,'Dashboard'] )
    ->middleware(['auth', 'verified'])->name('dashboard');
    
Route::middleware(['auth',''])->group(function () {
    Route::get('/addcategory', [AdminController::class, 'addCategory'])->name('admin.addcategory');

    Route::post('/addcategory', [AdminController::class, 'postAddCategory'])->name('admin.postaddcategory');

    Route::get('/viewcategory', [AdminController::class, 'viewCategory'])->name('admin.viewcategory');

    Route::get('/viewinventory', [AdminController::class, 'viewInventory'])->name('admin.viewinventory');

    Route::get('/deletecategory/{id}', [AdminController::class, 'deleteCategory'])->name('admin.deletecategory');

    Route::get('/updatecategory/{id}', [AdminController::class, 'updateCategory'])->name('admin.updatecategory');
 
    Route::post('/updatecategory/{id}', [AdminController::class, 'postUpdateCategory'])->name('admin.postupdatecategory');

    Route::post('user/components/process', function () {
    return view('process'); // Loads resources/views/other-file.blade.php
});

    Route::get('/addsupplier', [AdminController::class, 'addSupplier'])->name('admin.addsupplier');
    
    Route::post('/addsupplier', [AdminController::class, 'postAddSupplier'])->name('admin.postaddsupplier');

    Route::get('/admin.viewsupplier', [AdminController::class, 'viewSupplier'])->name('admin.viewsupplier');

    Route::get('/admin.deletesupplier/{id}', [AdminController::class, 'deleteSupplier'])->name('admin.deletesupplier');

    Route::get('/admin.updatesupplier/{id}', [AdminController::class, 'updateSupplier'])->name('admin.updatesupplier');

    Route::post('/postupdatesupplier/{id}', [AdminController::class, 'postUpdateSupplier'])->name('admin.postupdatesupplier');

    Route::get('/admin.addproduct', [AdminController::class, 'addProduct'])->name('admin.addproduct');

    Route::post('/addproduct', [AdminController::class, 'postAddProduct'])->name('admin.postaddproduct');

    Route::get('/admin.viewproduct', [AdminController::class, 'viewProduct'])->name('admin.viewproduct');

    Route::get('/admin.deleteproduct/{id}', [AdminController::class, 'deleteProduct'])->name('admin.deleteproduct');

    Route::get('/admin.updateproduct/{id}', [AdminController::class, 'updateProduct'])->name('admin.updateproduct');

    Route::post('/postupdateproduct/{id}', [AdminController::class, 'postUpdateProduct'])->name('admin.postupdateproduct');


    Route::get('/admin/order/create', [AdminController::class, 'create'])->name('admin.order.create');
    Route::post('/admin/order/store', [AdminController::class, 'store'])->name('admin.order.store');



    // Add to Cart Page
    Route::get('/admin/cart/add', [AdminController::class, 'addPage'])->name('admin.cart.add_page');

    // Add Item
    Route::post('/admin/cart/add', [AdminController::class, 'add'])->name('admin.cart.add');

    // View Cart
    Route::get('/admin/cart', [AdminController::class, 'viewCart'])->name('admin.cart.view');


    Route::get('/admin/cart', [AdminController::class, 'viewCart'])->name('admin.cart.view');


    // Remove Item
    Route::post('/admin/cart/remove', [AdminController::class, 'remove'])->name('admin.cart.remove');

    // Checkout
    Route::post('/admin/cart/checkout', [AdminController::class, 'checkout'])->name('admin.cart.checkout');

    Route::get('/admin/order/add_to_cart', [AdminController::class, 'viewCart'])->name('admin.order.add_to_cart');


    Route::get('/admin/inventory', [AdminController::class, 'inventory'])->name('admin.inventory');

    
     Route::post('/user/cart', [AdminController::class, 'postAddInventory'])->name('user.postaddinventory');

    Route::get('/user/orders', [AdminController::class, 'index'])->name('user.orders');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// routes/web.php
// routes/web.php


require __DIR__.'/auth.php';
