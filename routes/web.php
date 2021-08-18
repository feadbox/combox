<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTransactionController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Reports;
use App\Http\Controllers\SafeController;
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

Route::view('/', 'dashboard')->name('dashboard');

Route::resource('users', UserController::class);

Route::resource('positions', PositionController::class)->except('show');

Route::resource('branches', BranchController::class)->except('show');

Route::resource('products', ProductController::class)->except('show');

Route::resource('tags', TagController::class)->except('show');

Route::resource('safes', SafeController::class);

Route::resource('accounts', AccountController::class);

Route::get('salaries', [SalaryController::class, 'index'])->name('salaries.index');

Route::group(['prefix' => 'reports', 'as' => 'reports.'], function () {
    Route::get(
        'product-transactions',
        [Reports\ProductTransactionController::class, 'index']
    )->name('product-transactions.index');

    Route::get(
        'product-transactions/{product}',
        [Reports\ProductTransactionController::class, 'show']
    )->name('product-transactions.show');
});
