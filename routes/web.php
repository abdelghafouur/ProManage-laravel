<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DevisController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\PaimentController;
use App\Http\Controllers\DetailDevisController;
use App\Http\Controllers\DetailFactureController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\DashboardController;

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

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('clients', ClientController::class);
    Route::resource('devis', DevisController::class);
    Route::resource('factures', FactureController::class);
    Route::resource('paiments', PaimentController::class);
    Route::resource('users', UserController::class);
    Route::resource('entreprises', EntrepriseController::class);
    Route::resource('details', DetailDevisController::class);
    Route::resource('detailsFac', DetailFactureController::class);
    Route::get('/generate-Dev/{DevisId}', [PdfController::class, 'generateDev'])->name('Dev.generate');
    Route::get('/generate-Fac/{FactureId}', [PdfController::class, 'generateFac'])->name('Fac.generate');
    Route::post('/update-entreprise', [EntrepriseController::class, 'updateEntrepriseDefault'])->name('updateDEf.entreprise');
    
});

Route::middleware(['auth', 'restrict.comptable.access'])->group(function () {
    Route::resource('clients', ClientController::class);
    Route::resource('devis', DevisController::class);
    Route::resource('factures', FactureController::class)->except(['index', 'show']);
    Route::resource('paiments', PaimentController::class)->except(['index', 'show']);
    Route::resource('users', UserController::class)->except(['edit','update']);
    Route::resource('entreprises', EntrepriseController::class);
    Route::resource('details', DetailDevisController::class)->except(['show']);
    Route::resource('detailsFac', DetailFactureController::class)->except(['show']);
});

Route::middleware(['auth', 'restrict.admin.access'])->group(function () {
    Route::resource('clients', ClientController::class)->only(['delete']);
    Route::resource('devis', DevisController::class)->only(['delete']);
    Route::resource('factures', FactureController::class)->only(['delete']);
    Route::resource('paiments', PaimentController::class)->only(['delete']);
    Route::resource('details', DetailDevisController::class)->only(['delete']);
    Route::resource('detailsFac', DetailFactureController::class)->only(['delete']);
});