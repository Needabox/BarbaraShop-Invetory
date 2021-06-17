<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GrController;
use App\Http\Controllers\PoController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PerusahaanController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {

    //Dashboard
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    //Suppliers
    Route::get('/suppliers', [SupplierController::class, 'index'])->name('supplier');
    Route::POST('/suppliers/store', [SupplierController::class, 'store'])->name('supplier.store');
    Route::get('/suppliers/edit/{id}', [SupplierController::class, 'edit'])->name('supplier.edit');
    Route::POST('/suppliers/update/{id}', [SupplierController::class, 'update'])->name('supplier.update');
    Route::get('/suppliers/delete/{id}', [SupplierController::class, 'destroy'])->name('supplier.delete');
    Route::get('/search', [SupplierController::class, 'search'])->name('search');

    //Product
    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::get('/products/details/{id}', [ProductController::class, 'modal'])->name('products.details');
    Route::POST('/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::POST('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::get('/product/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');

    //Manage Po
    Route::get('/purchase-order', [PoController::class, 'index'])->name('po');
    Route::get('/purchase-order/product/{supplier}', [PoController::class, 'getproduct'])->name('po.product');
    Route::get('/purchase-order/add', [PoController::class, 'create'])->name('po.create');
    Route::POST('/purchase-order/store', [PoController::class, 'store'])->name('po.store');
    Route::get('/purchase-order/approve/{id}', [PoController::class, 'approve'])->name('po.approve');
    Route::get('/purchase-order/details/{id}', [PoController::class, 'details'])->name('po.details');
    Route::POST('/purchase-order/update-qty/{id}', [PoController::class, 'updateQty'])->name('po.update.qty');
    Route::get('/purchase-order/hapus/{id}', [PoController::class, 'destroy'])->name('po.delete');
    Route::get('/purchase-order/cetak-details/{id}', [PoController::class, 'cetak'])->name('po.cetak');

    //Good Receipt
    Route::get('/goods-receipt', [GrController::class, 'index'])->name('gr');
    Route::get('/goods-receipt/details/{id}', [GrController::class, 'details'])->name('gr.details');
    Route::POST('/purchase-order/approve/{id}', [GrController::class, 'approve'])->name('po.approve');

    //Pos
    Route::get('/pos', [PosController::class, 'index'])->name('pos');
    Route::get('/pos/product/{kode}', [PosController::class, 'get_product'])->name('pos.product');
    Route::POST('/pos/insert', [PosController::class, 'store'])->name('pos.create');

    //Sales
    Route::get('/sales', [SalesController::class, 'index'])->name('sales');
    Route::get('/sales/filter', [SalesController::class, 'filter'])->name('sales.filter');
    Route::get('/sales/details/{id}', [SalesController::class, 'details'])->name('sales.details');

    //Perusahaan
    Route::get('perusahaan', [PerusahaanController::class, 'index'])->name('perusahaan');
    Route::POST('perusahaan/update', [PerusahaanController::class, 'update'])->name('update.perusahaan');
});