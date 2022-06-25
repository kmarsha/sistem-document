<?php

use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DocumentDetailController;
use App\Http\Controllers\RemarkController;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::middleware('auth')->group(function() {   
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Route::resource('documents', DocumentController::class);

    Route::get('documents', [DocumentController::class, 'index'])->name('documents.list');

    // Route::resource('document', DocumentController::class)->except('index');

    Route::get('document/create', [DocumentController::class, 'create'])->name('document.create');
    Route::post('document', [DocumentController::class, 'store'])->name('document.store');
    Route::get('document/{document}/edit', [DocumentController::class, 'edit'])->name('document.edit');
    Route::put('document/{document}', [DocumentController::class, 'update'])->name('document.update');
    Route::delete('document/{document}', [DocumentController::class, 'destroy'])->name('document.destroy');

    Route::middleware('isApprover')->group(function() {
        Route::get('documents/remarked', [RemarkController::class, 'remarkList'])->name('documents.remark-list');

        Route::put('document/{document}/remark', [RemarkController::class, 'remark'])->name('document.remarking');
        // Route::put('document/{document}/approve', [RemarkController::class, 'reject'])->name('document.reject');
    });
});

