<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BomController;
use App\Http\Controllers\RfqController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PurchaseOrderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route BomController
Route::get('bom', [BomController::class, 'index']);
Route::get('bom/{id}', [BomController::class, 'show']);
Route::post('bom', [BomController::class, 'store']);
Route::put('bom/{id}', [BomController::class, 'update']);
Route::delete('bom/{id}', [BomController::class, 'delete']);

// Route CustomerController
Route::get('customer', [CustomerController::class, 'index']);
Route::get('customer/{id}', [CustomerController::class, 'show']);
Route::post('customer', [CustomerController::class, 'store']);
Route::put('customer/{id}', [CustomerController::class, 'update']);
Route::delete('customer/{id}', [CustomerController::class, 'delete']);


// Route ProdukController

Route::get('/produk', [ProdukController::class, 'index']);
Route::get('/produk/{id}', [ProdukController::class, 'show']);
Route::post('/produk', [ProdukController::class, 'store']);
Route::put('/produk/{id}', [ProdukController::class, 'update']);
Route::delete('/produk/{id}', [ProdukController::class, 'hapus']);



// Route PurchaseOrderController
Route::get('purchase_order', [PurchaseOrderController::class, 'index']);
Route::get('purchase_order/{id}', [PurchaseOrderController::class, 'show']);
Route::post('purchase_order', [PurchaseOrderController::class, 'store']);
Route::put('purchase_order/{id}', [PurchaseOrderController::class, 'update']);
Route::delete('purchase_order/{id}', [PurchaseOrderController::class, 'hapus']);

// Route RfqController
Route::get('rfq', [RfqController::class, 'index']);
Route::get('rfq/{id}', [RfqController::class, 'show']);
Route::post('rfq', [RfqController::class, 'store']);
Route::put('rfq/{id}', [RfqController::class, 'update']);
Route::delete('rfq/{id}', [RfqController::class, 'hapus']);

// Route Vendor Controller
Route::get('vendor', [VendorController::class, 'index']);
Route::get('vendor/{id}', [VendorController::class, 'show']);
Route::post('vendor', [VendorController::class, 'store']);
Route::put('vendor/{id}', [VendorController::class, 'update']);
Route::delete('vendor/{id}', [VendorController::class, 'hapus']);
