<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BomController;
use App\Http\Controllers\RfqController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PurchaseOrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// Route Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard/manufacturing/manufacturing', [DashboardController::class, 'manufacturing'])->name('dashboard.manufacturing');
Route::get('/dashboard/manufacturing/vendor', [DashboardController::class, 'vendor'])->name('dashboard.manufacturing.vendor');
Route::get('/dashboard/manufacturing/bill-of-materials', [DashboardController::class, 'billOfMaterials'])->name('dashboard.manufacturing.bill_of_materials');
Route::get('/dashboard/manufacturing/material', [DashboardController::class, 'material'])->name('dashboard.manufacturing.material');
Route::get('/dashboard/products', [DashboardController::class, 'products'])->name('dashboard.products.produk');
Route::get('/dashboard/purchasing', [DashboardController::class, 'purchasing'])->name('dashboard.purchasing');
Route::get('/dashboard/sales', [DashboardController::class, 'sales'])->name('dashboard.sales');


