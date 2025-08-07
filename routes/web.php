<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StockTransactionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockOpnameController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
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
Route::name('index-practice')->get('/', function () {
    return view('pages.practice.index');
});

Route::name('practice.')->group(function () {
    Route::name('first')->get('practice/1', function () {
        return view('pages.practice.1');
    });
    Route::name('second')->get('practice/2', function () {
        return view('pages.practice.2');
    });
});

Route::get('/login', [LoginController::class, 'showLoginPage'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// Route untuk halaman utama/dashboard setelah login
Route::middleware('auth')->get('/', function () {
    return view('pages.practice.index');
})->name('index-practice');


Route::middleware('auth')->group(function () {
    Route::get('/transactions', [StockTransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/create', [StockTransactionController::class, 'create'])->name('transactions.create');
    Route::post('/transactions', [StockTransactionController::class, 'store'])->name('transactions.store');
});

Route::get('/stock-opname', function () {
    $products = \App\Models\Product::all();
    return view('pages.transactions.opname', compact('products'));
})->name('stock.opname');



Route::resource('products', ProductController::class);

Route::get('opname', [StockOpnameController::class, 'index'])->name('opname.index');
Route::put('opname', [StockOpnameController::class, 'update'])->name('opname.update');



Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
Route::get('/reports/transactions', [ReportController::class, 'transactions'])->name('reports.transactions');
Route::get('/reports/stocks', [ReportController::class, 'stocks'])->name('reports.stocks');
Route::get('/reports/export/pdf', [ReportController::class, 'exportPDF'])->name('reports.export.pdf');
Route::get('/reports/export/excel', [ReportController::class, 'exportExcel'])->name('reports.export.excel');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class);
});

