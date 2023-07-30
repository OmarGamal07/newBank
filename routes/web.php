<?php

use App\Http\Controllers\BankController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
// */

Auth::routes();
Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/add', [TransferController::class, 'create'])->name('transfer.create');
    Route::get('/addaccount', [UserController::class, 'create'])->name('account.create');
    Route::get('/admin', [TransferController::class, 'index'])->name('transfer.index');
    Route::post('/storeTransfer', [TransferController::class, 'store'])->name('transfer.store');
    Route::post('/updateStatus', [TransferController::class, 'update'])->name('update.status');
    Route::post('/save-bank',[BankController::class,'store'])->name('bank.store');
    Route::post('/save-type',[TypeController::class,'store'])->name('type.store');
});
Route::group(['middleware' => 'auth'], function () {
    Route::post('/filter',[TransferController::class, 'filter'])->name('transfer.filter');
    Route::get('/all-data', [TransferController::class, 'fetchAllData'])->name('all.data');
    Route::get('transfers-export',[TransferController::class, 'export'])->name('transfers.export');
    Route::post('transfers-import',[TransferController::class,'import'])->name('transfers.import');
    Route::get('/my-transfers',[TransferController::class, 'clientTransfers'])->name('client.transfers');
    Route::get('/forgot-password', [UserController::class, 'edit'])->name('forgotPassword');
    Route::post('/update-password', [UserController::class, 'update'])->name('updatePassword');

});



