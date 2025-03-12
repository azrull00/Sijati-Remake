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
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
Route::get('/dashboard/manufacturing', [DashboardController::class, 'manufacturing'])->name('dashboard.manufacturing');
Route::get('/dashboard/vendor', [DashboardController::class, 'vendor'])->name('dashboard.vendor');
Route::get('/dashboard/material', [DashboardController::class, 'material'])->name('dashboard.material');
Route::get('/dashboard/products', [DashboardController::class, 'products'])->name('dashboard.products');
Route::get('/dashboard/purchasing', [DashboardController::class, 'purchasing'])->name('dashboard.purchasing');
Route::get('/dashboard/sales', [DashboardController::class, 'sales'])->name('dashboard.sales');
Route::get('/dashboard/manufacturing/bill-of-materials', [DashboardController::class, 'billOfMaterials'])->name('dashboard.manufacturing.bill_of_materials');


// View route
Route::get('/products', function () {
    return view('Dashboard.products');
})->name('products');

// API routes
Route::prefix('produk')->group(function () {
    Route::get('/', [ProdukController::class, 'index']);
    Route::post('/', [ProdukController::class, 'store']);
    Route::get('/{id}', [ProdukController::class, 'show']);
    Route::put('/{id}', [ProdukController::class, 'update']);
    Route::delete('/{id}', [ProdukController::class, 'hapus']);
});
