<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\XmlController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/dashboard');
});
Route::get('/dashboard/sales/boleta', [SaleController::class , 'lookboleta'])->name('dash.boleta');
Route::get('/dashboard/sales/boleta/{code}', [SaleController::class , 'pdfboleta'])->name('dash.pdfboleta');
Route::get('/dashboard/sales/factura', [SaleController::class , 'lookfactura'])->name('dash.factura');
Route::post('/dashboard/sales/boleta', [SaleController::class , 'storeBoleta'])->name('boleta.store');
Route::get('/dashboard/welcome', function() {
    return view('welcome.tabwelcome');
});
Route::post('/createXML', [XmlController::class, 'createXML']);
Route::get('/clients/dni', [ClienteController::class , 'lookdni']);
Route::get('/clients/ruc', [ClienteController::class , 'lookruc']);


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard');
