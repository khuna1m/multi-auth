<?php

use Illuminate\Support\Facades\Route;

// Import Controller
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\AddressController;

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

// Way to call a controller without import the file
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::view('/home', 'home')->middleware('auth');

Auth::routes();
 
Route::prefix('admin')->group(function () {
    Route::view('/dashboard', 'admin')->middleware('admin');
    Route::get('/login', [LoginController::class, 'showAdminLoginForm']);
    Route::post('/login', [LoginController::class, 'adminLogin']);
    Route::get('/register', [RegisterController::class, 'showAdminRegisterForm']);
    Route::post('/register', [RegisterController::class, 'createAdmin']);
});

Route::get('/form', [AddressController::class, 'showForm']);