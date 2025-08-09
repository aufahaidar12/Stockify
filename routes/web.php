<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StockTransactionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockOpnameController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/login', [LoginController::class, 'showLoginPage'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    // Dashboard / Home
    Route::get('/', [DashboardController::class, 'index'])->name('index-practice');
    
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });

    // Practice routes
    Route::name('practice.')->group(function () {
        Route::get('/practice/1', function () {
            return view('pages.practice.1');
        })->name('first');

        Route::get('/practice/2', function () {
            return view('pages.practice.2');
        })->name('second');
    });

    // Stock Transactions
    Route::get('/transactions', [StockTransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/create', [StockTransactionController::class, 'create'])->name('transactions.create');
    Route::post('/transactions', [StockTransactionController::class, 'store'])->name('transactions.store');

    // Stock Opname
    Route::get('/stock-opname', function () {
        $products = \App\Models\Product::all();
        return view('pages.transactions.opname', compact('products'));
    })->name('stock.opname');

    Route::get('/opname', [StockOpnameController::class, 'index'])->name('opname.index');
    Route::put('/opname', [StockOpnameController::class, 'update'])->name('opname.update');

    // Product Resource
    Route::resource('products', ProductController::class);

    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/transactions', [ReportController::class, 'transactions'])->name('reports.transactions');
    Route::get('/reports/stocks', [ReportController::class, 'stocks'])->name('reports.stocks');

    Route::resource('suppliers', SupplierController::class);

    // Users (admin only)
    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class);
    });
});