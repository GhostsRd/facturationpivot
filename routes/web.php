<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
*/

Route::get('/', function () {
    return view('contact-pivot');
});

Route::get('/audit-produit', function () {
    return view('audit-produit');
})->middleware('auth');

Route::get('/contacts', function () {
    return view('contact-pivot');
});

Route::get('/facturation-telma', function () {
    return view('facturation-telma');
})->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
