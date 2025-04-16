<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\DiamondMaster\DiamondShadeController;
use App\Http\Controllers\DiamondMaster\DiamondClarityMasterController;
use App\Http\Controllers\DiamondMaster\DiamondKeyToSymbolsMasterController;
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
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard'); // welcome page
    })->name('admin.dashboard');

    Route::controller(DiamondClarityMasterController::class)->group(function () {
        Route::get('/clarity', 'index')->name('clarity.index');
        Route::post('/clarity', 'store')->name('clarity.store');
        Route::get('/clarity/{id}', 'show')->name('clarity.show'); 
        Route::put('/clarity/{id}', 'update')->name('clarity.update');
        Route::delete('/clarity/{id}', 'destroy')->name('clarity.destroy');
    });

    Route::controller(DiamondShadeController::class)->group(function () {
        Route::get('/shades', 'index')->name('shades.index');
        Route::post('/shades', 'store')->name('shades.store');
        Route::get('/shades/{id}', 'show')->name('shades.show'); 
        Route::put('/shades/{id}', 'update')->name('shades.update');
        Route::delete('/shades/{id}', 'destroy')->name('shades.destroy');
    });

    Route::controller(DiamondKeyToSymbolsMasterController::class)->group(function () {
        Route::get('/keyToSymbols', 'index')->name('keytosymbols.index');
        Route::get('/keyToSymbols/create', 'create')->name('keytosymbols.create');
        Route::get('/keyToSymbols/{id}/edit', 'edit')->name('keytosymbols.edit');
        Route::get('/keyToSymbols/{id}', 'show')->name('keytosymbols.show');
        Route::post('/keyToSymbols', 'store')->name('keytosymbols.store');
        Route::put('/keyToSymbols/{id}', 'update')->name('keytosymbols.update');
        Route::delete('/keyToSymbols/{id}', 'destroy')->name('keytosymbols.destroy');
    });
});
