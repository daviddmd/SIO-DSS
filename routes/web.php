<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaftUpload;
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
    return redirect()->route("dashboard");
    //return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::resource("companies", CompanyController::class);
    Route::resource("customers", CustomerController::class);
    Route::resource("products", ProductController::class);
    Route::resource("invoices", InvoiceController::class);
    Route::get("/saft-upload", [SaftUpload::class, "index"])->name("saft-upload.index");
    Route::post("/saft-upload", [SaftUpload::class, "store"])->name("saft-upload.store");
});
