<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AccountPaymentController;
use App\Http\Controllers\AccountTransferController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Reports;
use App\Http\Controllers\TipController;
use App\Http\Controllers\UserVacationController;
use App\Http\Controllers\UserWorkingDateController;
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

Route::group(['middleware' => 'auth'], function () {
    Route::redirect('/', '/accounts');

    Route::post('users/{user}/vacations', [UserVacationController::class, 'store'])->name('users.vacations.store');
    Route::put('users/{user}/working-dates/update', [UserWorkingDateController::class, 'update'])->name('users.working-dates.update');
    Route::resource('users', UserController::class);

    Route::resource('positions', PositionController::class)->except('show');

    Route::resource('branches', BranchController::class)->except('show');

    Route::resource('products', ProductController::class)->except('show');

    Route::resource('tags', TagController::class)->except('show');

    Route::get('accounts/transfer', [AccountTransferController::class, 'index'])->name('accounts.transfers.index');
    Route::post('accounts/transfer', [AccountTransferController::class, 'store'])->name('accounts.transfers.store');
    Route::resource('accounts.payments', AccountPaymentController::class)->only('store');
    Route::resource('accounts', AccountController::class);

    Route::get('salaries', [SalaryController::class, 'index'])->name('salaries.index');
    Route::post('salaries', [SalaryController::class, 'store'])->name('salaries.store');

    Route::get('tips', [TipController::class, 'index'])->name('tips.index');
    Route::post('tips', [TipController::class, 'store'])->name('tips.store');

    Route::group(['prefix' => 'reports', 'as' => 'reports.'], function () {
        Route::get('expenses', [Reports\ExpenseController::class, 'index'])->name('expenses.index');
        Route::get('tags', [Reports\TagController::class, 'index'])->name('tags.index');
    });
});
