<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
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
    return view('heydrown.home');
})->name('outside.home');

Route::get('/products', function () {
    return view('heydrown.products');
})->name('outside.products');

Route::get('/product/this-is-slug', function () {
    return view('heydrown.product');
});

Route::get('/about', function () {
    return view('heydrown.about');
})->name('outside.about');


Route::get('/login', function () {
    return view('heydrown.auth.login');
});

Route::get('/dashboard', function () {
    return view('heydrown.dashboard.index');
})->name('dashboard');

Auth::routes();

Route::get('/login/{website}', [LoginController::class, 'redirectToProvider'])->name('social.login');
Route::get('/login/{website}/callback', [LoginController::class, 'handleProviderCallback'])->name('social.callback');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
