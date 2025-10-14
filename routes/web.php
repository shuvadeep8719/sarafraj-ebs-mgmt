<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BankController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SocialSchemeController;
use App\Http\Controllers\CustomerDocumentController;

/*Route::get('/', function () {
    return view('welcome');
});*/

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Temporary routes for checking UI screens.
| Later, you can replace these with controller-based routes.
|
*/


// Authentication
/*Route::middleware('guest.dashboard')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');

});*/


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');


Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');
//Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Protect all routes after login
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Customers (resource routes)
    Route::resource('customers', CustomerController::class);


    // AJAX validation route (for real-time checks)
    Route::post('/validate-bank-account', [CustomerController::class, 'validateBankAccount'])->name('customers.validateBank');


    // Banks
    //Route::resource('banks', BankController::class);

    // Schemes
    //Route::resource('schemes', SocialSchemeController::class);

    // Business / Queries / Invoice UI previews
    Route::get('/business', fn () => view('business.index'))->name('business');
    //Route::get('/queries', fn () => view('queries.index'))->name('queries');
    //Route::get('/invoice', fn () => view('invoice.index'))->name('invoice');

    Route::delete('/customer-documents/{document}', [CustomerDocumentController::class, 'destroy'])
        ->name('customer-documents.destroy');

});


// Login Page (before-login layout)
/*Route::get('/', function () {
    return view('auth.login');   // resources/views/auth/login.blade.php
})->name('login');

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard'); // resources/views/dashboard/index.blade.php
})->name('dashboard');

// Customers
Route::get('/customers', function () {
    return view('customers.index'); // resources/views/customers/index.blade.php
})->name('customers');


Route::resource('customers', CustomerController::class);


// Target Business
Route::get('/business', function () {
    return view('business.index');  // resources/views/business/index.blade.php
})->name('business');

// Banking Queries
Route::get('/queries', function () {
    return view('queries.index');   // resources/views/queries/index.blade.php
})->name('queries');

// Invoice Management
Route::get('/invoice', function () {
    return view('invoice.index');   // resources/views/invoice/index.blade.php
})->name('invoice');*/
